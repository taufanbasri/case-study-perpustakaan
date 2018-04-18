<?php

namespace App;

use Session;
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

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($author) {
            // cek penulis apakah punya buku
            if ($author->books->count() > 0) {
                // buat pesan error
                $messageHtml = 'Penulis tidak bisa dihapus karena masih memiliki buku: ';
                $messageHtml .= '<ul>';

                foreach ($author->books as $book) {
                    $messageHtml .= "<li>$book->title</li>";
                }

                $messageHtml .= '</ul>';

                Session::flash('flash_notification', [
                    'level' => 'danger',
                    'message' => $messageHtml,
                ]);

                // batalkan proses hapus penulis
                return false;
            }
        });
    }
}
