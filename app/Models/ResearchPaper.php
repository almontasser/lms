<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

  public function getCover()
  {
    return $this->thumbnail ? '/uploads/' . $this->thumbnail : '/media/no_cover.jpg';
  }
}
