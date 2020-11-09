<?php

namespace App\Http\Controllers;

use App\Models\DaftarPustaka;
use App\Models\Pustaka;
use Illuminate\Http\Request;

class PustakaController extends Controller
{
    public function printNomor($id)
    {
        $daftarPustaka = DaftarPustaka::select('kodepustaka', 'info1')->where('pustaka', $id)->get();
        $pustaka = Pustaka::findOrFail($id);
        return view('pustaka.print-nomor', compact('daftarPustaka', 'pustaka'));
    }
}
