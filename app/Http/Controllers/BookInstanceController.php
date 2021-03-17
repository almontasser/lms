<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookInstance;
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

  public function store(Book $book, Request $request)
  {
    $instance_number = $book->bookInstances()->count() + 1;

    // not allowing more than 99 instances
    if ($instance_number > 99) {
      return back();
    }

    $instance_number_str = ($instance_number > 9 ? substr($instance_number, 0, 1) : '0') . ($instance_number % 10);

    $barcode = substr_replace($book->barcode, $instance_number_str, 1, 2);

    BookInstance::create([
      'book_id' => $book->id,
      'barcode' => $barcode,
      'status' => 'available',
      'instance_number' => $instance_number
    ]);

    return back();
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
}
