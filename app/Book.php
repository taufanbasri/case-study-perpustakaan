<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'amount', 'cover', 'author_id'
    ];

    public function author()
    {
      return $this->belongsTo(Author::class);
    }

    public function borrowLogs()
    {
      return $this->hasMany(BorrowLog::class);
    }

    public function getStockAttribute()
    {
        $borrowed = $this->borrowLogs()->borrowed()->count();
        $stock = $this->amount - $borrowed;

        return $stock;
    }
}
