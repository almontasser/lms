<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookInstance;
use App\Models\BookInstanceMovement;
use App\Models\User;
use Illuminate\Http\Request;

class BookInstanceController extends Controller
{
  public function index(Book $book)
  {
    return view('books.instances', [
      'book' => $book,
      'book_instances' => $book->bookInstances()->get()
    ]);
  }

  public function show_generate(Book $book)
  {
    return view('books.instances-generate', [
      'book' => $book
    ]);
  }

  public function generate(Book $book, Request $request)
  {
    $this->validate($request, [
      'quantity' => 'required|numeric'
    ]);

    $quantity = $request->input('quantity');

    $instance_number = 0;
    $last_instance = $book->bookInstances()->orderBy('instance_number', 'DESC')->first();
    if (isset($last_instance)) {
      $instance_number = $last_instance->instance_number;
    }

    $new_barcodes = [];

    for ($i = 0; $i < $quantity; $i++) {
      $instance_number++;
      if ($instance_number > 99) {
        break;
      }

      $instance_number_str = ($instance_number > 9 ? substr($instance_number, 0, 1) : '0') . ($instance_number % 10);

      $barcode = substr(substr_replace($book->barcode, $instance_number_str, 1, 2), 0, -1);
      $barcode = generateEAN13Checksum($barcode);

      BookInstance::create([
        'book_id' => $book->id,
        'barcode' => $barcode,
        'status' => 'available',
        'instance_number' => $instance_number
      ]);

      $new_barcodes[] = $barcode;
    }

    return view('books.instances', [
      'new_barcodes' => $new_barcodes,
      'url' => route('book-instances', ['book' => $book]),
      'book' => $book,
      'book_instances' => $book->bookInstances()->get()
    ]);
  }

  public function show_instance(BookInstance $book_instance)
  {
    return view('books.show-instance', [
      'book_instance' => $book_instance
    ]);
  }

  public function lend(BookInstance $book_instance, Request $request)
  {
    if ($book_instance->status != 'available') {
      return response()->json([
        'success' => false,
        'error' => 'النسخة ليست متاحة للاعارة'
      ]);
    }

    $id_number = $request->input('id');
    $user = User::where('id_number', $id_number)->first();

    if (!isset($user))
    {
      // Should not happen
      return response()->json([
        'success' => false,
        'error' => 'رقم العضو بيس موجودا'
      ]);
    }

    $lending_days = $book_instance->book->lending_days;
    $borrow_start = date('Y-m-d');
    $borrow_end = date('Y-m-d', strtotime('+' . $lending_days . ' days'));
    if (date("l", strtotime($borrow_end)) == 'Friday')
    {
      $lending_days++;
      $borrow_end = date('Y-m-d', strtotime('+' . $lending_days. ' days'));
    }
    BookInstanceMovement::create([
      'book_instance_id' => $book_instance->id,
      'user_id' => $user->id,
      'borrow_start' => $borrow_start,
      'borrow_end' => $borrow_end
    ]);

    $book_instance->update([
      'status' => 'loaned'
    ]);

    return response()->json([
      'success' => true,
    ]);
  }

  public function return_book(BookInstance $book_instance)
  {
    if ($book_instance->status != 'loaned') {
      // Should never happen
      return response()->json([
        'success' => false,
        'error' => 'النسخة ليست معارة'
      ]);
    }

    $movement = $book_instance->movements()->orderBy('id', 'DESC')->first();

    $movement->update([
      'borrow_returned' => date('Y-m-d')
    ]);

    $book_instance->update([
      'status' => 'available'
    ]);

    return response()->json([
      'success' => true,
    ]);
  }

  public function borrowed()
  {
    $movements = BookInstanceMovement::where('borrow_returned', NULL)->get();

    return view('books.borrowed', [
      'movements' => $movements
    ]);
  }
}
