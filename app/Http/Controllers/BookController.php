<?php

namespace App\Http\Controllers;

use App\Http\Filters\BookFilter;
use App\Models\Book;
use App\Models\BookInstance;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
  public function list(BookFilter $filter)
  {
    return view('books.list', [
      'books' => Book::filter($filter)->simplePaginate(5),
      'fields' => Field::all(),
    ]);
  }

  public function create()
  {
    return view('books.edit', [
      'edit' => false,
      'book' => null
    ]);
  }

  private function validateInputs(Request $request)
  {
    $request['lending_days'] = $request['lending_days'] ?? 14;

    $this->validate($request, [
      'title' => 'required|max:255',
      'author' => 'max:255',
      'publisher' => 'max:255',
      'subject' => 'max:255',
      'field_id' => '',
      'specialty_id' => '',
      'print_year' => 'max:50',
      'edition' => 'max:50',
      'ISBN' => 'max:50',
      'category' => 'max:255',
      'price' => '',
      'lending_days' => 'integer|between:0,14',
      'row' => '',
      'col' => '',
      'rack' => '',
      'notes' => '',
      'description' => '',
      'file' => $request->file('file') != null ? 'mimes:pdf' : '',
      'thumbnail' =>
      $request->file('thumbnail') != null ?
        'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000' : '',
    ]);
  }

  public function store(Request $request)
  {
    $this->validateInputs($request);

    $inputs = $request->only([
      'title', 'author', 'publisher', 'subject', 'field_id', 'specialty_id', 'print_year',
      'edition', 'ISBN', 'category', 'price', 'row', 'col', 'rack', 'notes', 'description',
      'lending_days'
    ]);

    do {
      $inputs['barcode'] = generateEAN13('100');
    } while (!Book::where('barcode', $inputs['barcode'])->get()->isEmpty());

    if ($request->hasFile('file')) {
      $inputs["file"] = $inputs['barcode'] . '.pdf';
      $request->file->storeAs('books', $inputs["file"]);
    }

    // if ($request->file('file')) {
    //     $file = $inputs['barcode'] . '.pdf';
    //     $request->file('file')->move(public_path('uploads'), $file);

    //     $inputs['file'] = $file;
    // }

    if ($request->file('thumbnail')) {
      $thumbnail = $inputs['barcode'] . '.' . $request->file('thumbnail')->extension();
      $request->file('thumbnail')->move(public_path('uploads'), $thumbnail);


      $inputs['thumbnail'] = $thumbnail;
    }

    Book::create($inputs);

    return redirect()->route('books');
  }

  public function edit(Book $book)
  {
    return view('books.edit', [
      'edit' => true,
      'book' => $book
    ]);
  }

  public function update(Book $book, Request $request)
  {
    $this->validateInputs($request);

    $inputs = $request->only([
      'title', 'author', 'publisher', 'subject', 'field_id', 'specialty_id', 'print_year',
      'edition', 'ISBN', 'category', 'price', 'row', 'col', 'rack', 'notes', 'description',
      'lending_days'
    ]);

    if ($request->hasFile('file')) {
      $inputs["file"] = $inputs['barcode'] . '.pdf';
      $request->file->storeAs('books', $inputs["file"]);
    }

    // if ($request->file('file')) {
    //     $file = $inputs['barcode'] . '.pdf';
    //     $request->file('file')->move(public_path('uploads'), $file);

    //     $inputs['file'] = $file;
    // }

    if ($request->file('thumbnail')) {
      $thumbnail = $book->barcode . '.' . $request->file('thumbnail')->extension();
      $request->file('thumbnail')->move(public_path('uploads'), $thumbnail);

      $inputs['thumbnail'] = $thumbnail;
    }

    $book->update($inputs);

    return redirect()->route('books');
  }

  public function index()
  {
    return view('books.index');
  }

  public function show(Book $book)
  {
    return view('books.show', ['book' => $book]);
  }

  public function download(Book $book)
  {
    $path = storage_path('app/books/' . $book->file);
    return response()->download($path, sanitize_file_name($book->title . ".pdf"));
  }

  public function show_import_from_csv()
  {
    return view('books.import-from-csv');
  }

  function csvToArray($filename = '', $delimiter = ',')
  {
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
        {
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }

    return $data;
  }

  public function import_from_csv(Request $request)
  {
    // Get uploaded CSV file
    $file = $request->file('csv');

    $books = $this->csvToArray($file->getRealPath());
    for ($i = 0; $i < count($books); $i ++)
    {
      do {
        $barcode = generateEAN13('100');
      } while (!Book::where('barcode', $barcode)->get()->isEmpty());

      $b = Book::create([
        'title' => $books[$i]['NABO'],
        'author' => $books[$i]['NAED'],
        'barcode' => $barcode,
        'lending_days' => 14,
        'old_NS' => $books[$i]['NS'],
        'old_NO' => $books[$i]['NO'],
        'old_CLA' => $books[$i]['CLA'],
        'old_SUB' => $books[$i]['SUB'],
        'old_CLA1' => $books[$i]['CLA1'],
        'old_TYPE' => $books[$i]['TYPE'],
      ]);

      $instance_number = 0;

      for ($j = 0; $j < $books[$i]['NO']-1; $j++) {
        $instance_number++;
        if ($instance_number > 99) {
          break;
        }

        $instance_number_str = ($instance_number > 9 ? substr($instance_number, 0, 1) : '0') . ($instance_number % 10);

        $barcode = substr(substr_replace($b->barcode, $instance_number_str, 1, 2), 0, -1);
        $barcode = generateEAN13Checksum($barcode);

        BookInstance::create([
          'book_id' => $b->id,
          'barcode' => $barcode,
          'status' => 'available',
          'instance_number' => $instance_number
        ]);
      }
    }
  }

  public function get_books_json() {
    return [
      'data' => Book::all('id', 'title', 'author', 'publisher', 'edition', 'ISBN', 'barcode')->toArray()
    ];
  }
}
