<?php

namespace App\Http\Controllers;

use App\Models\{Pembayaran, Siswa, Spp, Petugas, User};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class PembayaranController extends Controller
{
    public function index()
    {

        $pembayaran = DB::table('Pembayaran')
        ->join('siswa' , 'pembayaran.nisn' , '=' , 'siswa.nisn')
        ->join('spp', 'pembayaran.id_spp', '=', 'spp.id')
        ->get();
        // dd($siswa);
        $spp = Spp::all();
        $siswa = Siswa::all();
        $petugas = Petugas::all();
        $users = User::all();
        return view('pembayaran.index', compact('pembayaran', 'siswa', 'spp' , 'users', 'petugas'));
    }

    public function create()
    {

    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'nisn' => 'required|numeric',
            'jumlah_bayar' => 'required|numeric',
        ]);


        // dd($request->bulan_dibayar);
        for ($i = 0; $i < $request->bulan_dibayar ; $i++) {
            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $siswa = Siswa::where('nisn', '=', $request->nisn)->first();
            $spp = Spp::where('id', '=', $siswa->id_spp)->first();
            $pembayaran = Pembayaran::where('nisn', '=', $siswa->nisn)->get();

            if ($pembayaran->isEmpty()) {
                $bln = 6;
                $tahun = substr($spp->tahun, 0, 4);
            } else {
                $pembayaran = Pembayaran::where('nisn', '=', $siswa->nisn)
                    ->orderBy('id', 'Desc')->latest()
                    ->first();

                $bln = array_search($pembayaran->bulan_dibayar, $bulan);

                if ($bln == 11) {
                    $bln = 0;
                    $tahun = $pembayaran->tahun_dibayar + 1;
                } else {
                    $bln = $bln + 1;
                    $tahun = $pembayaran->tahun_dibayar;
                }

                if ($pembayaran->tahun_dibayar == substr($spp->tahun, -4, 4) && $pembayaran->bulan_dibayar == 'mei') {
                    toast('Sudah Lunas', 'error');
                    return back();
                }
            }

            if ($request->jumlah_bayar < $spp->nominal) {
                toast('Uang tidak mencukupi','error');
                return back();
            }

            // dd($bulan[$bln]);
            $pembayaranSimpan = Pembayaran::create([
                'id_petugas' => auth()->user()->id,
                'nisn' => $request->nisn,
                'tgl_bayar' => Carbon::now(),
                'bulan_dibayar' => $bulan[$bln],
                'tahun_dibayar' => $tahun,
                'id_spp' => $spp->id,
                'jumlah_bayar' => $request->jumlah_bayar 
            ]);   
        }
        if ($pembayaranSimpan) {
                toast('Berhasil Ditambahkan', 'success');
                return redirect()->route('pembayaran.index');
            } else {
                toast('Gagal Ditambahkan', 'error');
                return redirect()->back();
            }
    }

    // public function destroy(Pembayaran $pembayaran)
    // {
    //     $pembayaran->delete();
    //     toast('Berhasil Dihapus', 'success');
    //     return redirect()->route('pembayaran.index')
    //                     ->with('success','Berhasil Hapus !');
    // }


    public function getData($nisn , $berapa)
    {
        $siswa = Siswa::where('nisn', '=', $nisn)->first();
        $spp = Spp::where('id', '=', $siswa->id_spp)->first();
        $pembayaran = Pembayaran::where('nisn', '=', $nisn)
            ->orderBy('id', 'Desc')->latest()
            ->first();


        if ($pembayaran == null) {
            $data = [
                'nominal' => $spp->nominal * $berapa,
                'bulan' => 'belum pernah bayar',
                'tahun' => '',
            ];
        } else {

            if ($pembayaran->tahun_dibayar == substr($spp->tahun, -4, 4) && $pembayaran->bulan_dibayar == 'juni') {
                $data = [
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => 'sudah lunas',
                    'tahun' => '',
                ];
            } else {
                $data = [
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => $pembayaran->bulan_dibayar,
                    'tahun' => $pembayaran->tahun_dibayar,
                ];
            }
        }

        return response()->json($data);
    }
}
