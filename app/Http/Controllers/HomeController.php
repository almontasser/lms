<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Project;
use App\Models\ResearchPaper;
use Illuminate\Http\Request;
use JanisKelemen\Setting\Facades\Setting;

class HomeController extends Controller
{
  public function index()
  {
    if (!Setting::get('settings_initiated')) {
      return view('settings.index', [
        'initiation' => true
      ]);
    }

    $books_count = Book::count();
    $projects_count = Project::count();
    $papers_count = ResearchPaper::count();
    return view('home', [
      'books_count' => $books_count,
      'projects_count' => $projects_count,
      'papers_count' => $papers_count
    ]);
  }
}
