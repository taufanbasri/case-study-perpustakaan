<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Book;
use App\Author;

class BookImportController extends Controller
{
    public function generateExcelTemplate()
    {
        Excel::create('Template Import Buku', function ($excel) {
            $excel->setTitle('Template Import Buku')
                    ->setCreator('Perpustakaan Online')
                    ->setCompany('Perpustakaan Online')
                    ->setDescription('Template import buku untuk Perpustakaan Online');

            $excel->sheet('Data Buku', function ($sheet) {
                $row = 1;
                $sheet->row($row, [
                    'judul',
                    'penulis',
                    'jumlah'
                ]);
            });
        })->export('xls');
    }

    public function importExcel(Request $request)
    {
        // validasi file yang di upload harus excel
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx,ods'
        ]);

        $excel = $request->excel;

        // baca sheet pertama
        $excels = Excel::selectSheetsByIndex(0)->load($excel)->get();

        // validasi row pada file excel
        $rowRules = [
            'judul' => 'required|unique:books,title',
            'penulis' => 'required',
            'jumlah' => 'required'
        ];

        // catat semua ID Buku baru untuk menghitung total buku yang berhasil di import
        $book_id = [];

        // looping setiap baris dari baris kedua, yang pertama adalah nama kolom
        foreach ($excels as $row) {
            // validasi untuk role excel
            $validator = Validator::make($row->toArray(), $rowRules);

            // lewati baris yang tidak valid, lanjut ke baris selanjutnya
            if ($validator->fails()) {
                continue;
            }

            // jika valid maka di eksekusi & cek apakah penulis sudah ada di database
            $author = Author::where('name', $row['penulis'])->first();

            // buat penulis jika belum tercatat di database
            if (!$author) {
                $author = Author::create(['name' => $row['penulis']]);
            }

            // buat buku baru
            $book = Book::create([
                'title' => $row['judul'],
                'author_id' => $author->id,
                'amount' => $row['jumlah']
            ]);

            // catat ID Buku yang berhasil dibuat
            array_push($book_id, $book->id);
        }

        // get semua buku yang baru dibuat
        $books = Book::whereIn('id', $book_id)->get();

        // redirect ke form jika tidak ada buku yang berhasil di import
        if ($books->count() == 0) {
            return redirect()->back()->with('flash_notification', [
                'level' => 'danger',
                'message' => 'Tidak ada buku yang berhasil di import atau data buku sudah ada.'
            ]);
        }

        // jika berhasil tampilkan index buku
        return redirect()->route('books.index')->with('flash_notification', [
            'level' => 'success',
            'message' => "Berhasil mengimport " . $books->count() . " buku."
        ]);
    }
}
