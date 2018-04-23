<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorrowLog extends Model
{
    protected $fillable = [
        'book_id', 'user_id', 'is_returned'
    ];

    public function book()
    {
      return $this->belongsTo(Book::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
