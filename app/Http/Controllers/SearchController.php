<?php

namespace App\Http\Controllers;

use App\Concerns\BM25;
use App\Concerns\MultilingualStemmer;
use App\Models\Book;
use App\Models\Project;
use App\Models\ResearchPaper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use TeamTNT\TNTSearch\TNTSearch;


class MbSimilarText
{
  /**
   * Implementation of `mb_similar_text()`.
   *
   * @see http://php.net/manual/en/function.similar-text.php
   * @see http://locutus.io/php/strings/similar_text/
   *
   * @param string $str1
   * @param string $str2
   * @param float  &$percent
   *
   * @return int
   */
  public static function mb_similar_text($str1, $str2, &$percent = null)
  {
    if (0 === mb_strlen($str1) + mb_strlen($str2)) {
      $percent = 0.0;

      return 0;
    }

    $pos1 = $pos2 = $max = 0;
    $l1 = mb_strlen($str1);
    $l2 = mb_strlen($str2);

    for ($p = 0; $p < $l1; ++$p) {
      for ($q = 0; $q < $l2; ++$q) {
        for ($l = 0; ($p + $l < $l1) && ($q + $l < $l2) && mb_substr($str1, $p + $l, 1) === mb_substr($str2, $q + $l, 1); ++$l) {
          // nothing to do
        }
        if ($l > $max) {
          $max = $l;
          $pos1 = $p;
          $pos2 = $q;
        }
      }
    }

    $similarity = $max;
    if ($similarity) {
      if ($pos1 && $pos2) {
        $similarity += self::mb_similar_text(mb_substr($str1, 0, $pos1), mb_substr($str2, 0, $pos2));
      }
      if (($pos1 + $max < $l1) && ($pos2 + $max < $l2)) {
        $similarity += self::mb_similar_text(
          mb_substr($str1, $pos1 + $max, $l1 - $pos1 - $max),
          mb_substr($str2, $pos2 + $max, $l2 - $pos2 - $max)
        );
      }
    }

    $percent = ($similarity * 200.0) / ($l1 + $l2);

    return $similarity;
  }
}

class SearchController extends Controller
{


  function normalize($search_string)
  {
    $patterns     = array("/(ا|إ|أ|آ)/", "/(ه|ة)/");
    $replacements = array("ا", "ه");
    return preg_replace($patterns, $replacements, $search_string);
  }

  public function paginate($items, $perPage = 5, $page = null)
  {
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);
    return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => Paginator::resolveCurrentPath()]);
  }

  public function simplePaginate($items, $perPage = 5, $page = null)
  {
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make(array_slice($items, $page * $perPage - $perPage, null, true));
    return new Paginator($items, $perPage, $page, ['path' => Paginator::resolveCurrentPath(), 'page' => $page]);
  }

  private function mb_split_str($str)
  {
    preg_match_all("/./u", $str, $arr);
    return $arr[0];
  }

  //based on http://www.phperz.com/article/14/1029/31806.html, added percent
  private function mb_similar_text($str1, $str2, &$percent)
  {
    $arr_1 = array_unique($this->mb_split_str($str1));
    $arr_2 = array_unique($this->mb_split_str($str2));
    $similarity = count($arr_2) - count(array_diff($arr_2, $arr_1));
    $percent = ($similarity * 200) / (strlen($str1) + strlen($str2));
    return $similarity;
  }



  static public function string_compare($str_a, $str_b)
  {
    $length = strlen($str_a);
    $length_b = strlen($str_b);

    $i = 0;
    $segmentcount = 0;
    $segmentsinfo = array();
    $segment = '';
    while ($i < $length) {
      $char = substr($str_a, $i, 1);
      if (strpos($str_b, $char) !== FALSE) {
        $segment = $segment . $char;
        if (strpos($str_b, $segment) !== FALSE) {
          $segmentpos_a = $i - strlen($segment) + 1;
          $segmentpos_b = strpos($str_b, $segment);
          $positiondiff = abs($segmentpos_a - $segmentpos_b);
          $posfactor = ($length - $positiondiff) / $length_b; // <-- ?
          $lengthfactor = strlen($segment) / $length;
          $segmentsinfo[$segmentcount] = array('segment' => $segment, 'score' => ($posfactor * $lengthfactor));
        } else {
          $segment = '';
          $i--;
          $segmentcount++;
        }
      } else {
        $segment = '';
        $segmentcount++;
      }
      $i++;
    }

    // PHP 5.3 lambda in array_map
    $totalscore = array_sum(array_map(function ($v) {
      return $v['score'];
    }, $segmentsinfo));
    return $totalscore;
  }

  public function search(Request $request)
  {
    $s = strtolower($this->normalize($request->input('s')));

    $tnt = new TNTSearch;
    $tnt->loadConfig([
      'driver'    => env('DB_CONNECTION'),
      'host'      => env('DB_HOST'),
      'port'      => env('DB_PORT'),
      'database'  => env('DB_DATABASE'),
      'username'  => env('DB_USERNAME'),
      'password'  => env('DB_PASSWORD'),
      'storage'   => storage_path(),
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
    ]);
    $tnt->selectIndex("content.index");
    $tnt->fuzziness = false;
    // $tnt->fuzzy_prefix_length = 4;
    // $tnt->fuzzy_max_expansions = 6;
    // $tnt->fuzzy_max_expansions = 500;
    $res = $tnt->search($s, 500);

    $book_ids = [];
    $paper_ids = [];
    $project_ids = [];
    foreach ($res['ids'] as $id) {
      if (str_starts_with($id, 'book_')) {
        $book_ids[] = substr($id, 5);
      } else if (str_starts_with($id, 'paper_')) {
        $paper_ids[] = substr($id, 6);
      } else if (str_starts_with($id, 'project_')) {
        $project_ids[] = substr($id, 8);
      }
    }

    $searchResults = [];

    $docs = [];

    $stemmer = new MultilingualStemmer();

    $q = explode(' ', $s);
    foreach ($q as $key => $_q) {
      $q[$key] = $stemmer->stem($_q);
    }

    $books = Book::whereIn('id', $book_ids)->get();
    foreach ($books as $book) {
      $searchResults[] = ['model' => $book];
      $docs[] = $book->title . ' ' . $book->author . ' ' . $book->publisher . ' ' . $book->description;
    }

    $papers = ResearchPaper::whereIn('id', $paper_ids)->get();
    foreach ($papers as $paper) {
      $searchResults[] = ['model' => $paper];
      $docs[] = $paper->title . ' ' . $paper->author . ' ' . $paper->abstract;
    }

    $projects = Project::whereIn('id', $project_ids)->get();
    foreach ($projects as $project) {
      $searchResults[] = ['model' => $project];
      $docs[] = $project->title . ' ' . $project->authors . ' ' . $project->supervisor . ' '
        . $project->sub_supervisor . ' ' . $project->abstract . ' ' . $project->conclusion;
    }

    $results = [];
    if (count($docs) > 0) {
      $docs = BM25::score($q, $docs, $stemmer, 0.75, 0, false, false);
      foreach ($docs as $key => $score) {
        $searchResults[$key]['score'] = $score;
        $results[] = $searchResults[$key];
      }
    }

    $results = $this->simplePaginate($results, 20);

    return view('search.index', ['results' => $results->appends($request->except('page'))]);
  }
}
