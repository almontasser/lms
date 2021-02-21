<?php

namespace App\Http\Controllers;

use App\Http\Filters\BookFilter;
use App\Models\Book;
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'subject' => 'required|max:255',
            'field_id' => 'required',
            'specialty_id' => 'required',
            'print_year' => 'required|min:4|max:50',
            'edition' => 'required|max:50',
            'ISBN' => 'required|max:50',
            'category' => 'required|max:255',
            'price' => '',
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

        $inputs = $request->only(['title', 'author', 'publisher', 'subject', 'field_id', 'specialty_id', 'print_year',
            'edition', 'ISBN', 'category', 'price', 'row', 'col', 'rack', 'notes', 'description']);

        do {
            $inputs['barcode'] = generateRandomString(6);
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

        $inputs = $request->only(['title', 'author', 'publisher', 'subject', 'field_id', 'specialty_id', 'print_year',
            'edition', 'ISBN', 'category', 'price', 'row', 'col', 'rack', 'notes', 'description']);

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

        $book->update($inputs);

        return redirect()->route('books');
    }

    public function index()
    {
        return view('books.index', [
            'books' => Book::all(),
        ]);
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
}
