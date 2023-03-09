<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Siswa, Rombel, User, Spp};
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = DB::table('siswa')
        ->join('rombel' , 'siswa.id_kelas' , '=' , 'rombel.id')
        ->join('spp', 'siswa.id_spp', '=', 'spp.id')
        ->get();

        // dd($siswa);
        $rombel = Rombel::all();
        $spp = Spp::all();
                
        return view('siswa.index', compact('siswa' , 'rombel' , 'spp'));
    }

    public function create()
    {

    }

    public function store(Request $request) 
    {   
        $nisn = Siswa::where('nisn', $request->nisn)->get();

        if (sizeof($nisn) == 1) {
            toast('Siswa dengan NISN : ' . $request['nisn'] . ' sudah ada sebelumnya.', 'error');
            return redirect()->back();
        };

        Siswa::create([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->kompetensi_keahlian,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_spp' => $request->id_spp
        ]);

        User::create([
            'name'  => $request->nama,
            'email' => $request->nis.'@gmail.com',
            'password' => Hash::make($request->nis),
            'type' => '0'

        ]);
        toast('Berhasil Ditambahkan', 'success');
        return redirect()->route('siswa.index');
    }

    public function edit(Siswa $siswa)
    {
        // return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $nisn)
    {
        // dd($request);
        $request->validate([
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required'
        ]);

        Siswa::where('nisn', $nisn)->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_spp' => $request->id_spp
        ]);
        toast('Data Berhasil Diubah', 'success');
        return redirect()->route('siswa.index');    
    }
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        toast('Berhasil Dihapus', 'success');
        return redirect()->route('siswa.index');
    }
}
