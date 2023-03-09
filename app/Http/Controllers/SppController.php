<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    public function index()
    {
        $spp = Spp::latest()->paginate(5);
        return view('spp.index', compact('spp'));
    }

    public function create()
    {

    }

    public function store(Request $request) 
    {
        Spp::create([
            'tahun'=> $request->tahun,
            'nominal'=>$request->nominal
        ]);
        toast('Berhasil Ditambahkan', 'success');
        return redirect()->route('spp.index');
    }

    public function edit(Spp $spp)
    {

    }

    public function update(Request $request, Spp $spp)
    {
        $request->validate([
            'tahun'=>'required',
            'nominal'=>'required'
            ]);
        $spp->update([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal
        ]);
        toast('Data Berhasil Diubah', 'success');
        return redirect()->route('spp.index');
       
    }
    public function destroy(Spp $spp)
    {
        $spp->delete();
        toast('Berhasil Dihapus', 'success');
        return redirect()->route('spp.index');
    }
}
