<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookInstanceMovement extends Model
{
    use HasFactory;

    protected $fillable = [
      'book_instance_id',
      'user_id',
      'borrow_start',
      'borrow_end',
      'borrow_returned'
    ];

    public function book_instance()
    {
      return $this->belongsTo(BookInstance::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
