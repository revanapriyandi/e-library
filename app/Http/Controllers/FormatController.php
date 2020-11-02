<?php

namespace App\Http\Controllers;

use App\Models\Format;
use App\Models\Pustaka;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FormatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Format::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addColumn('jml_judul', function ($row) {
                    $judul = Pustaka::where('format', $row->id)->count();
                    return $judul;
                })
                ->addColumn('jml_pustaka', function ($row) {
                    $jumlah = Pustaka::where('format', $row->id)->sum('jumlah');
                    return $jumlah;
                })
                ->addColumn('aksi', function ($row) {

                    $btn = '<a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

                    return $btn;
                })
                ->addIndexColumn()
                ->rawColumns(['jml_pustaka', 'jml_judul', 'aksi'])
                ->make(true);
        }
        return view('format.index');
    }
}
