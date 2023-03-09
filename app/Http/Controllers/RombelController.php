<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rombel;
use SebastianBergmann\Comparator\Comparator;

class RombelController extends Controller
{
    public function index()
    {
        $rombel = Rombel::latest()->paginate(5);
        return view('rombel.index', compact('rombel'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Rombel::create([
            'nama_rombel'=> $request->nama_rombel,
            'kompetensi_keahlian'=>$request->kompetensi_keahlian
        ]);
        toast('Berhasil Ditambahkan', 'success');
        return redirect()->route('rombel.index');
    }

    public function edit()
    {
        //
    }

    public function update(Request $request, Rombel $rombel)
    {
        $request->validate([
            'nama_rombel'=>'required',
            'kompetensi_keahlian'=>'required'
            ]);
        $rombel->update([
            'nama_rombel' => $request->nama_rombel,
            'kompetensi_keahlian' => $request->kompetensi_keahlian
        ]);
        toast('Data Berhasil Diubah', 'success');
        return redirect()->route('rombel.index');
    }

    public function destroy(Rombel $rombel)
    {
        $rombel->delete();
        toast('Berhasil Dihapus', 'success');
        return redirect()->route('rombel.index');
    }
}
