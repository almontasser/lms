<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookInstance extends Model
{
  use HasFactory;

  protected $fillable = [
    'book_id',
    'barcode',
    'status',
    'instance_number'
  ];

  public function book()
  {
    return $this->belongsTo(Book::class);
  }

  public function movements()
  {
    return $this->hasMany(BookInstanceMovement::class);
  }
}
