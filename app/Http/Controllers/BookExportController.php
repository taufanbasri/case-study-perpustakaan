<?php

namespace App\Http\Controllers;

use PDF;
use Excel;
use App\Book;
use App\Author;
use Illuminate\Http\Request;

class BookExportController extends Controller
{
    public function export()
    {
        $authors = Author::pluck('name', 'id')->all();

        return view('books.export', compact('authors'));
    }

    public function exportPost(Request $request)
    {
        $request->validate([
            'author_id' => 'required',
            'type' => 'required|in:pdf,xls'
        ], [
            'author_id.required' => 'Anda belum memilih penulis, silahkan pilih minimal 1 penulis.'
        ]);

        $books = Book::whereIn('author_id', $request->author_id)->get();

        // untuk menentukan method mana yang dipanggil berdasar type yang dipilih
        // pilihannya exportXls() atau exportPdf()
        $handler = 'export' .ucfirst($request->type);

        return $this->$handler($books);
    }

    public function exportXls($books)
    {
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

    public function exportPdf($books)
    {
        $pdf = PDF::loadview('pdf.books', compact('books'));

        // langsung di download
        // return $pdf->download('data-buku.pdf');

        // preview sebelum di download
        return $pdf->stream('data-buku.pdf');
    }
}
