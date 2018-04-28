<?php

namespace App;

use App\Book;
use App\Mail\SendVerification;
use App\Exceptions\BookException;
use Illuminate\Support\Facades\Mail;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = ['is_verified'];

    public function borrowLogs()
    {
        return $this->hasMany(BorrowLog::class);
    }

    public function borrow(Book $book)
    {
        // cek stock Buku
        if ($book->stock < 1) {
            throw new BookException("Buku $book->title sedang tidak tersedia");
        }

        // cek apakah buku sedang dipinjam
        if ($this->borrowLogs()->where('book_id', $book->id)->where('is_returned', 0)->count() > 0) {
            throw new BookException("Buku $book->title sedang Anda pinjam.");
        }

        return BorrowLog::create([
            'user_id' => auth()->user()->id,
            'book_id' => $book->id
        ]);
    }

    public function sendEmailVerification()
    {
        $token = $this->generateVerificationCode();

        $user = $this;

        Mail::to($user)->send(new SendVerification($user));
    }

    public function generateVerificationCode()
    {
        $token = $this->verification_token;

        if (!$token) {
            $token = str_random(40);
            $this->verification_token = $token;
            $this->save();
        }

        return $token;
    }

    public function verify()
    {
        $this->is_verified = 1;
        $this->verification_token = null;
        $this->save();
    }
}
