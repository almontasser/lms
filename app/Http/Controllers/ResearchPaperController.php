<?php

namespace App\Http\Controllers;

use App\Models\ResearchPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ResearchPaperController extends Controller
{
  private function validateInputs(Request $request)
  {
    $this->validate($request, [
      'title' => 'required|max:255',
      'author' => 'required|max:255',
      'year' => 'max:50',
      'row' => '',
      'col' => '',
      'rack' => '',
      'notes' => '',
      'abstract' => '',
      'file' => $request->file('file') != null ? 'mimes:pdf' : '',
      'thumbnail' =>
      $request->file('thumbnail') != null ?
        'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000' : '',
    ]);
  }

  private function getInputs(Request $request)
  {
    return $request->only(['title', 'author', 'year', 'row', 'col', 'rack',
      'notes', 'abstract'
    ]);
  }

  public function create()
  {
    return view('papers.edit', [
      'edit' => false,
      'paper' => null
    ]);
  }

  public function store(Request $request)
  {
    $this->validateInputs($request);
    $inputs = $this->getInputs($request);

    do {
      $inputs['barcode'] = generateEAN13('200');
    } while (!ResearchPaper::where('barcode', $inputs['barcode'])->get()->isEmpty());

    if ($request->hasFile('file')) {
      $inputs["file"] = $inputs['barcode'] . '.pdf';
      $request->file->storeAs('papers', $inputs["file"]);
    }

    if ($request->file('thumbnail')) {
      $thumbnail = $inputs['barcode'] . '.' . $request->file('thumbnail')->extension();
      $request->file('thumbnail')->move(public_path('uploads'), $thumbnail);
      $inputs['thumbnail'] = $thumbnail;
    }

    ResearchPaper::create($inputs);

    return redirect()->route('papers');
  }

  public function edit(ResearchPaper $paper)
  {
    return view('papers.edit', [
      'edit' => true,
      'paper' => $paper
    ]);
  }

  public function update(ResearchPaper $paper, Request $request)
  {
    $this->validateInputs($request);
    $inputs = $this->getInputs($request);

    if ($request->hasFile('file')) {
      $inputs["file"] = $inputs['barcode'] . '.pdf';
      $request->file->storeAs('papers', $inputs["file"]);
    }

    if ($request->file('thumbnail')) {
      $thumbnail = $paper->barcode . '.' . $request->file('thumbnail')->extension();
      $request->file('thumbnail')->move(public_path('uploads'), $thumbnail);
      $inputs['thumbnail'] = $thumbnail;
    }

    $paper->update($inputs);

    return redirect()->route('papers');
  }

  public function index()
  {
    return view('papers.index');
  }

  public function get_papers_json() {
    return [
      'data' => ResearchPaper::all('id', 'title', 'author', 'year', 'barcode')->toArray()
    ];
  }

  public function download(ResearchPaper $paper)
  {
    $path = storage_path('app/papers/' . $paper->file);

    return Response::make(file_get_contents($path), 200, [
      'Content-Type'        => 'application/pdf',
      'Content-Disposition' => 'inline; filename="'.$paper->title.'"'
    ]);
  }

  public function show(ResearchPaper $paper)
  {
    return view('papers.show', [
      'paper' => $paper
    ]);
  }

  public function list()
  {
    return view('papers.list', [
      'papers' => ResearchPaper::simplePaginate(5)
    ]);
  }
}
