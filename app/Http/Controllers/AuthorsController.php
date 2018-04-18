<?php

namespace App\Http\Controllers;

use Session;
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

            return Datatables::of($authors)
                    ->addColumn('action', function ($author) {
                        return view('datatable._action', [
                            'author_id' => $author->id,
                            'show_url' => route('authors.show', $author->id),
                            'edit_url' => route('authors.edit', $author->id),
                            'delete_url' => route('authors.destroy', $author->id)
                        ]);
                    })->toJson();
        }

        $html = $htmlBuilder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Nama'],
            ['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false],
        ]);

        return view('authors.index', compact('html'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:authors'
        ],
        [
            'name.required' => 'Harus diisi gak boleh kosong!',
            'name.unique' => 'Nama tersebut sudah ada didaftar, ganti yang lain!'
        ]);

        $author = Author::create($request->all());

        // Session::flash('flash_notification', [
        //     'level' => 'success',
        //     'message' => 'Berhasil menyimpan data penulis dengan nama ' . $author->name
        // ]);

        return redirect()->route('authors.index')->with('flash_notification', [
            'level' => 'success',
            'message' => 'Berhasil menyimpan data penulis dengan nama <strong style="color: red;">' . $author->name . '</strong>'
        ]);
    }

    // using data binding
    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    // cara biasa
    // public function show($id)
    // {
    //     $author = Author::findOrFail($id);
    //
    //     return view('authors.show', compact('author'));
    // }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|unique:authors,name,' . $author->id
        ],
        [
            'name.required' => 'Harus diisi gak boleh kosong!',
            'name.unique' => 'Nama tersebut sudah ada didaftar, ganti yang lain!'
        ]);

        $author->update($request->only('name'));

        return redirect()->route('authors.index')->with('flash_notification', [
            'level' => 'success',
            'message' => 'Berhasil merubah data penulis dengan nama <strong class="text-primary">' . $author->name . '</strong>'
        ]);
    }

    public function destroy(Author $author)
    {
        if (!$author->delete()) {
            return redirect()->back();
        }

        return redirect()->route('authors.index')->with('flash_notification', [
            'level' => 'danger',
            'message' => "<strong class='text-primary'>$author->name</strong> berhasil dihapus"
        ]);
    }
}
