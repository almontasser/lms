<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function find_barcode(string $barcode)
    {
        if (strlen($barcode) > 1) {

            if ($barcode[0] = '1') {
                // BOOK
                // Get Book
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
