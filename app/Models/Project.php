<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TeamTNT\TNTSearch\TNTSearch;

class Project extends Model
{
  use HasFactory;

  protected $fillable = [
    'barcode',
    'title',
    'authors',
    'supervisor',
    'sub_supervisor',
    'abstract',
    'conclusion',
    'semester',
    'year',
    'specialty_id',
    'stage_id',
    'row',
    'col',
    'rack',
    'notes',
    'file',
    'thumbnail',
  ];

  public static function boot()
  {
    parent::boot();

    self::created(function ($project) {
      $tnt = new TNTSearch();
      $tnt->loadConfig(TNTConfig());
      $tnt->selectIndex("content.index");
      $index = $tnt->getIndex();
      $index->insert([
        'id' => "project_$project->id", 'title' => $project->title,
        'authors' => $project->authors, 'abstract' => $project->abstract,
        'supervisor' => $project->supervisor, 'sub_supervisor' => $project->sub_supervisor,
        'conclusion' => $project->conclusion
      ]);
    });

    self::updated(function ($project) {
      $tnt = new TNTSearch();
      $tnt->loadConfig(TNTConfig());
      $tnt->selectIndex("content.index");
      $index = $tnt->getIndex();
      $index->update("project_$project->id", [
        'id' => "project_$project->id", 'title' => $project->title,
        'authors' => $project->authors, 'abstract' => $project->abstract,
        'supervisor' => $project->supervisor, 'sub_supervisor' => $project->sub_supervisor,
        'conclusion' => $project->conclusion
      ]);
    });

    self::deleted(function ($project) {
      $tnt = new TNTSearch();
      $tnt->loadConfig(TNTConfig());
      $tnt->selectIndex("content.index");
      $index = $tnt->getIndex();
      $index->delete("project_$project->id");
    });
  }

  public function stage()
  {
    return $this->belongsTo(Stage::class);
  }

  public function specialty()
  {
    return $this->belongsTo(Specialty::class);
  }

  public function getCover()
  {
    return $this->thumbnail ? '/uploads/' . $this->thumbnail : '/media/no_cover.jpg';
  }
}
