<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class AuthorsController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
        // cara biasa
        // $authors = Author::all();
        // return view('authors.index', compact('authors'));

        // cara dataTables
        if ($request->ajax()) {
            $authors = Author::all();

            return Datatables::of($authors)->toJson();
        }

        $html = $htmlBuilder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Nama']
        ]);

        return view('authors.index', compact('html'));
    }

    public function create()
    {
        return view('authors.create');
    }
}
