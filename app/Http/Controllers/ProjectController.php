<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
  private function validateInputs(Request $request)
  {
    $this->validate($request, [
      'title' => 'required|max:255',
      'authors' => 'required|max:255',
      'supervisor' => 'max:255',
      'sub_supervisor' => 'max:255',
      'abstract' => '',
      'conclusion' => '',
      'semester' => '',
      'specialty_id' => '',
      'stage_id' => '',
      'year' => 'max:50',
      'row' => '',
      'col' => '',
      'rack' => '',
      'notes' => '',
      'file' => $request->file('file') != null ? 'mimes:pdf' : '',
      'thumbnail' => $request->file('thumbnail') != null ?
        'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000' : '',
    ]);
  }

  private function getInputs(Request $request)
  {
    return $request->only([
      'title', 'authors', 'supervisor', 'sub_supervisor', 'year', 'row', 'col',
      'rack', 'notes', 'abstract', 'conclusion', 'semester', 'specialty_id',
      'stage_id',
    ]);
  }

  public function create()
  {
    return view('projects.edit', [
      'edit' => false,
      'project' => null
    ]);
  }

  public function store(Request $request)
  {
    $this->validateInputs($request);
    $inputs = $this->getInputs($request);

    do {
      $inputs['barcode'] = generateEAN13('300');
    } while (!Project::where('barcode', $inputs['barcode'])->get()->isEmpty());

    if ($request->hasFile('file')) {
      $inputs["file"] = $inputs['barcode'] . '.pdf';
      $request->file->storeAs('projects', $inputs["file"]);
    }

    if ($request->file('thumbnail')) {
      $thumbnail = $inputs['barcode'] . '.' . $request->file('thumbnail')->extension();
      $request->file('thumbnail')->move(public_path('uploads'), $thumbnail);
      $inputs['thumbnail'] = $thumbnail;
    }

    Project::create($inputs);

    return redirect()->route('projects');
  }

  public function edit(Project $project)
  {
    return view('projects.edit', [
      'edit' => true,
      'project' => $project
    ]);
  }

  public function update(Project $project, Request $request)
  {
    $this->validateInputs($request);
    $inputs = $this->getInputs($request);

    if ($request->hasFile('file')) {
      $inputs["file"] = $inputs['barcode'] . '.pdf';
      $request->file->storeAs('projects', $inputs["file"]);
    }

    if ($request->file('thumbnail')) {
      $thumbnail = $project->barcode . '.' . $request->file('thumbnail')->extension();
      $request->file('thumbnail')->move(public_path('uploads'), $thumbnail);
      $inputs['thumbnail'] = $thumbnail;
    }

    $project->update($inputs);

    return redirect()->route('projects');
  }

  public function index()
  {
    return view('projects.index');
  }

  public function get_projects_json()
  {
    return [
      'data' => Project::all('id', 'title', 'authors', 'supervisor', 'year', 'barcode')->toArray()
    ];
  }

  public function download(Project $project)
  {
    $path = storage_path('app/projects/' . $project->file);

    return Response::make(file_get_contents($path), 200, [
      'Content-Type'        => 'application/pdf',
      'Content-Disposition' => 'inline; filename="' . $project->title . '"'
    ]);
  }

  public function show(Project $project)
  {
    return view('projects.show', [
      'project' => $project
    ]);
  }

  public function list()
  {
    return view('projects.list', [
      'projects' => Project::simplePaginate(10)
    ]);
  }
}
