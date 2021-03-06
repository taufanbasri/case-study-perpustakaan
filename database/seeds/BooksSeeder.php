<?php

use App\Book;
use App\User;
use App\Author;
use App\BorrowLog;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // sample penulis
        $author1 = Author::create(['name' => 'Ozan Tamvan']);
        $author2 = Author::create(['name' => 'Kahlil Gibran']);
        $author3 = Author::create(['name' => 'Ryan Gosling']);

        // sample buku
        $book1 = Book::create([
            'title' => 'Kupinang kau dengan bismillah',
            'amount' => 3,
            'author_id' => $author1->id,
        ]);

        $book2 = Book::create([
            'title' => 'Bait baik puisi',
            'amount' => 5,
            'author_id' => $author2->id,
        ]);

        $book3 = Book::create([
            'title' => 'Harry Potter',
            'amount' => 7,
            'author_id' => $author3->id,
        ]);

        $book4 = Book::create([
            'title' => 'Detective Conan',
            'amount' => 10,
            'author_id' => $author3->id,
        ]);

        // buat contoh peminjaman buku
        $member = User::where('email', 'member@mail.com')->first();

        BorrowLog::create([
            'user_id' => $member->id,
            'book_id' => $book1->id,
            'is_returned' => 0
        ]);

        BorrowLog::create([
            'user_id' => $member->id,
            'book_id' => $book2->id,
            'is_returned' => 0
        ]);

        BorrowLog::create([
            'user_id' => $member->id,
            'book_id' => $book3->id,
            'is_returned' => 1
        ]);
    }
}
