@extends('layouts.master')
@section('content')
   
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">History Pembayaran</h4>
                {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambah">Tambah</button> --}}
                {{-- <h3 class="m-0 font-weight-bold text-secondary">Pembayaran</h3> --}}

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Petugas</th>
                                <th>Nisn</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Bulan Dibayar</th>
                                <th>Tahun Dibayar</th>
                                <th>Spp</th>
                                <th>Jumlah Bayar</th>
                                {{-- <th>action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $pm)
                            <tr>
                                <td>@foreach($users as $user)
                                    @if($user->id == $pm->id_petugas)
                                    {{$user->name}}
                                    @endif
                                    @endforeach
                                </td>
                                <td>{{$pm->nisn}}</td>
                                <td>{{$pm->nama}}</td>
                                <td>{{$pm->tgl_bayar}}</td>
                                <td>{{$pm->bulan_dibayar}}</td>
                                <td>{{$pm->tahun_dibayar}}</td>
                                <td> @foreach($spp as $s)
                                    @if($s->id == $pm->id_spp)
                                    {{$s->tahun}}
                                    @endif
                                    @endforeach
                                </td>
                                <td>Rp{{number_format($pm->jumlah_bayar, 2,",",".") }}</td>
                               {{-- <td>
                                     <a href="" class="btn btn-primary"> Print</a>
                                </form>
                                </td>  --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <script>
            $(document).ready(function(){
                $('#table').DataTable();
            });
            </script>

@endsection