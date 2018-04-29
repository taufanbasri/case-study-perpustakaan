<?php

namespace App\Http\Controllers;

use Excel;
use App\Book;
use App\Author;
use Illuminate\Http\Request;

class BookExportController extends Controller
{
    public function exportXls()
    {
        $authors = Author::pluck('name', 'id')->all();

        return view('books.export', compact('authors'));
    }

    public function exportPost(Request $request)
    {
        $request->validate([
            'author_id' => 'required'
        ], [
            'author_id.required' => 'Anda belum memilih penulis, silahkan pilih minimal 1 penulis.'
        ]);

        $books = Book::whereIn('author_id', $request->author_id)->get();

        Excel::create('Data Buku Perpustakaan', function ($excel) use ($books) {
            // set property
            $excel->setTitle('Data Buku')->setCreator(auth()->user()->name);

            $excel->sheet('Data Buku', function ($sheet) use ($books) {
                $row = 1;
                $sheet->row($row, [
                    'Judul',
                    'Jumlah',
                    'Stok',
                    'Penulis'
                ]);

                foreach ($books as $book) {
                    $sheet->row(++$row, [
                        $book->title,
                        $book->amount,
                        $book->stock,
                        $book->author->name,
                    ]);
                }
            });
        })->export('xls');
    }
}
