<?php

namespace App\Models;

use App\Concerns\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TeamTNT\TNTSearch\TNTSearch;

class Book extends Model
{
  use HasFactory, Filterable;

  protected $fillable = [
    'title',
    'author',
    'publisher',
    'subject',
    'field_id',
    'specialty_id',
    'file',
    'thumbnail',
    'print_year',
    'edition',
    'ISBN',
    'category',
    'price',
    'row',
    'col',
    'rack',
    'notes',
    'barcode',
    'description',
    'lending_days',
    'old_NS',
    'old_NO',
    'old_CLA',
    'old_SUB',
    'old_CLA1',
    'old_TYPE',
    'reviewed'
  ];

  public static function boot()
  {
    parent::boot();

    self::created(function ($book) {
      $tnt = new TNTSearch();
      $tnt->loadConfig(TNTConfig());
      $tnt->selectIndex("content.index");
      $index = $tnt->getIndex();
      $index->insert(['id' => "book_$book->id", 'title' => $book->title,
        'author' => $book->author, 'publisher' => $book->publisher,
        'description' => $book->description, 'subject' => $book->subject]);
    });

    self::updated(function($book) {
      $tnt = new TNTSearch();
      $tnt->loadConfig(TNTConfig());
      $tnt->selectIndex("content.index");
      $index = $tnt->getIndex();
      $index->update("book_$book->id", ['id' => "book_$book->id",
        'title' => $book->title, 'author' => $book->author,
        'publisher' => $book->publisher, 'description' => $book->description,
        'subject' => $book->subject]);
    });

    self::deleted(function($book) {
      $tnt = new TNTSearch();
      $tnt->loadConfig(TNTConfig());
      $tnt->selectIndex("content.index");
      $index = $tnt->getIndex();
      $index->delete("book_$book->id");
    });
  }

  public function field()
  {
    return $this->belongsTo(Field::class);
  }

  public function specialty()
  {
    return $this->belongsTo(Specialty::class);
  }

  public function getCover()
  {
    return $this->thumbnail ? '/uploads/' . $this->thumbnail : '/media/no_cover.jpg';
  }

  public function bookInstances()
  {
    return $this->hasMany(BookInstance::class);
  }
}
