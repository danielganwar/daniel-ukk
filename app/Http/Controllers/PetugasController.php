<?php

namespace App\Http\Controllers;

use App\Models\{Petugas, User};
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Alert;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::latest()->paginate(5);
        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
    }

    public function store(Request $request) 
    {
        // dd($request);
        Petugas::create([
            'username' => $request->username,
            'password' => $request->password,
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level
        ]);
        User::create([
            'name' => $request->nama_petugas,
            'email' => $request->username,
            'password' => Hash::make($request['password']),
            'type'=> $request->level
        ]);
        toast('Berhasil Ditambahkan', 'success');
        return redirect()->route('petugas.index');
    }

    public function edit(Petugas $petugas)
    {

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
            'nama_petugas'=>'required',
            'level'=>'required'
        ]);
        Petugas::where('id',$id)->update([
            'username'=> $request->username,
            'password'=> $request->password,
            'nama_petugas'=> $request->nama_petugas,
            'level'=> $request->level
        ]);
        toast('Data Berhasil Diubah', 'success');
        return redirect()->route('petugas.index');
       
    }


    public function destroy(Petugas $petugas, $id)
    {
        Petugas::Where('id', $id)->delete();
        toast('Berhasil Dihapus', 'success');
        return redirect()->route('petugas.index');
    }


}
