<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data pencarian dari input form jika ada
        $keyword = $request->input('keyword');

        // Mengambil data pegawai dari tabel 'pegawai' dengan pagination
        $pegawai = DB::table('pegawai');

        // Jika terdapat kata kunci pencarian, lakukan pencarian
        if ($keyword) {
            $pegawai->where('pegawai_nama', 'like', '%' . $keyword . '%');
        }

        // Pagination untuk data pegawai
        $pegawai = $pegawai->paginate(10);

        // Mengirim data pegawai ke view index beserta kata kunci pencarian
        return view('index', ['pegawai' => $pegawai, 'keyword' => $keyword]);
    }

    public function cari(Request $request)
{
    // Mendapatkan data pencarian dari form
    $keyword = $request->input('cari');

    // Melakukan pencarian data pegawai berdasarkan nama
    $pegawai = DB::table('pegawai')
                ->where('pegawai_nama', 'like', "%$keyword%")
                ->paginate(10);

    // Mengirim data pegawai hasil pencarian ke view
    return view('index', ['pegawai' => $pegawai]);
}

}