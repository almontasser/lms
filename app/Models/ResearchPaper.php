<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TeamTNT\TNTSearch\TNTSearch;

class ResearchPaper extends Model
{
    use HasFactory;

  protected $fillable = [
    'barcode',
    'title',
    'author',
    'year',
    'abstract',
    'file',
    'thumbnail',
  ];

  public static function boot()
  {
    parent::boot();

    self::created(function ($paper) {
      $tnt = new TNTSearch();
      $tnt->loadConfig(TNTConfig());
      $tnt->selectIndex("content.index");
      $index = $tnt->getIndex();
      $index->insert(['id' => "paper_$paper->id", 'title' => $paper->title,
        'author' => $paper->author, 'abstract' => $paper->abstract]);
    });

    self::updated(function($paper) {
      $tnt = new TNTSearch();
      $tnt->loadConfig(TNTConfig());
      $tnt->selectIndex("content.index");
      $index = $tnt->getIndex();
      $index->update("paper_$paper->id", ['id' => "paper_$paper->id",
        'title' => $paper->title, 'author' => $paper->author,
        'abstract' => $paper->abstract]);
    });

    self::deleted(function($paper) {
      $tnt = new TNTSearch();
      $tnt->loadConfig(TNTConfig());
      $tnt->selectIndex("content.index");
      $index = $tnt->getIndex();
      $index->delete("paper_$paper->id");
    });
  }

  public function getCover()
  {
    return $this->thumbnail ? '/uploads/' . $this->thumbnail : '/media/no_cover.jpg';
  }
}
