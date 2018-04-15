<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the Books for the model.
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
