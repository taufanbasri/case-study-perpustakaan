<?php

namespace App\Http\Controllers;

use App\Book;
use DataTables;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Laratrust\LaratrustFacade as Laratrust;

class GuestController extends Controller
{
    public function index(Request $request, Builder $builder)
    {
        if ($request->ajax()) {
            $books = Book::with('author')->get();

            return Datatables::of($books)
                    ->addColumn('action', function ($book) {
                        if (Laratrust::hasRole('admin')) {
                            return '';
                        }

                        return '<a class="btn btn-xs btn-primary" href="' . route('guest.books.borow', $book->id) . '">Pinjam Buku</a>';
                    })->toJson();
        }

        $html = $builder->columns([
            ['data' => 'title', 'name' => 'title', 'title' => 'Judul Buku'],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Jumlah Buku'],
            ['data' => 'author.name', 'name' => 'author.name', 'title' => 'Penulis'],
            ['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false],
        ]);

        return view('guest.index', compact('html'));
    }
}
