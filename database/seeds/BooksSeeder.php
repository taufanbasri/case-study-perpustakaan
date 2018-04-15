<?php

use App\Book;
use App\Author;
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
    }
}
