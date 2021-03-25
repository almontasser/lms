<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookInstance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarcodeController extends Controller
{
  public function find_barcode(string $barcode)
  {
    if (strlen($barcode) > 1) {

      if ($barcode[0] = '1') {
        // BOOK
        // Get Book

        /** @var User $user */
        $user = Auth::user();
        if (isset($user) && $user->isAdmin()) {
            $book_instance = BookInstance::where('barcode', $barcode)->first();
            if (isset($book_instance)) {
                return redirect()->route('book-instance', [$book_instance]);
            }
        }
        $book_barcode = substr_replace($barcode, '00', 1, 2);
        $book = Book::where('barcode', $book_barcode)->first();
        if (isset($book)) {
          return redirect()->route('book-show', [$book]);
        } else {
          return redirect()->route('books-list');
        }
      }
    }
  }
}
