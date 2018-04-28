<?php

namespace App\Http\Controllers;

use App\BorrowLog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class StatisticsController extends Controller
{
    public function index(Request $request, Builder $builder)
    {
        if ($request->ajax()) {
            $statistics = BorrowLog::with('book', 'user');

            return DataTables::of($statistics)
                    ->addColumn('returned_at', function ($statistic) {
                        if ($statistic->is_returned) {
                            return $statistic->updated_at->format('d/m/Y');
                        }

                        return "<strong class='text-success'>Masih dipinjam</strong>";
                    })
                    ->rawColumns(['returned_at'])
                    ->toJson();
        }

        $html = $builder->columns([
            ['data' => 'book.title', 'name' => 'book.title', 'title' => 'Judul'],
            ['data' => 'user.name', 'name' => 'user.name', 'title' => 'Peminjam'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Tanggal Peminjaman'],
            ['data' => 'returned_at', 'name' => 'returned_at', 'title' => 'Tanggal Kembali'],
        ]);

        return view('statistics.index', compact('html'));
    }
}
