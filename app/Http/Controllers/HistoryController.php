<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Spp, Pembayaran, Siswa, User};
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        $history = DB::table('Pembayaran')
        ->join('siswa' , 'pembayaran.nisn' , '=' , 'siswa.nisn')
        ->join('spp', 'pembayaran.id_spp', '=', 'spp.id')
        ->get();
        $spp = Spp::all();
        $siswa = Siswa::all();
        $users = User::all();

        return view('history.index', compact('spp','siswa','users','history'));
    }
}
