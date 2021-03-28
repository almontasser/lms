<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class SearchController extends Controller
{
  public function search(Request $request)
  {
    $terms = '%' . implode('%', explode(' ', $request->input('s'))) . '%';
    $s = generate_normalization_pattern($terms);

    // $searchResults = Book::whereRaw('MATCH (title, author, publisher, description) AGAINST (?)' , array($request->input('s')))->get();
    // $searchResults = Book::select(DB::raw('*, MATCH(title, author, publisher, description) AGAINST (?) AS score'))
    //   ->whereRaw('MATCH (title, author, publisher, description) AGAINST (?)', array($s, $s))
    //   ->orderBy('score', 'desc')
    //   ->get();
    // $searchResults = Book::query()
    //   ->where('title', 'LIKE', $s)
    //   ->orWhere('author', 'LIKE', $s)
    //   ->orWhere('publisher', 'LIKE', $s)
    //   ->orWhere('description', 'LIKE', $s)
    //   ->simplePaginate(10);
    $searchResults = Search::new()
      ->add(Book::class, ['title', 'author', 'publisher', 'description'])
      ->endWithWildcard(false)
      ->dontParseTerm()
      ->simplePaginate(10)
      ->get($s);

    // $searchResults = (new Search())
    //   ->registerModel(Book::class, 'title', 'author', 'publisher', 'description')
    //   ->search($request->input('s'));

        return view('search.index', ['searchResults' => $searchResults->appends($request->except('page'))]);
  }
}
