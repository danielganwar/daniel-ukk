@extends('layouts.master')
@section('content')

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </button>
            </div>  
            <div class="modal-body">
                <form action="{{route('siswa.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nisn</label>
                        <input type="number" class="form-control" name="nisn" placeholder="Masukan Nisn">
                    </div>
                    <div class="form-group">
                        <label for="">Nis</label>
                        <input type="number" class="form-control" name="nis" placeholder="Masukan Nis">
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <label for="">Rombel</label>
                        <select class="form-control" name="kompetensi_keahlian">
                            @foreach($rombel as $rombels)
                            <option value="{{$rombels->id }}">{{$rombels->kompetensi_keahlian}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat">
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telpon</label>
                        <input type="number" class="form-control" name="no_telp" placeholder="Masukan Nomor Telpon">
                    </div>
                    <div class="form-group">
                        <label for="">Spp</label>
                        <select class="form-control" name="id_spp">
                            @foreach($spp as $sp)
                            <option value="{{$sp->id}}">{{$sp->tahun}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambah">Tambah Siswa</button>
                {{-- <h3 class="m-0 font-weight-bold text-secondary">Data Rombel</h3> --}}

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                        @if ($siswa->count() == 0)
                        <div class="form-group">
                            <input type="text" class="form-control bg-danger text-white"
                                value=" Belum ada siswa satupun :( , Silahkan dilengkapi terlebih dahulu ">
                        @endif
                        </div>
                        <thead>
                            <tr>
                                <th>Nisn</th>
                                <th>Nis</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Alamat</th>
                                <th>Nomor Telpon</th>
                                <th>Spp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                            <tr>
                                <td>{{$s->nisn}}</td>
                                <td>{{$s->nis}}</td>
                                <td>{{$s->nama}}</td>
                                <td>{{$s->kompetensi_keahlian}}</td>
                                <td>{{$s->alamat}}</td>
                                <td>{{$s->no_telp}}</td>
                                <td>{{$s->tahun}}</td>
                                <td>
                                    <form action="{{route('siswa.destroy', $s->nisn)}}" method="POST" onsubmit="return confirm('Yakin Hapus {{ $s->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal2{{ $s->nisn }}" >Edit</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Show</button> --}}
                                    </form>
                                </td>
                                {{-- MODAL EDIT --}}
                                <div class="modal fade" id="modal2{{ $s->nisn }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Rombel</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>  
                                    <div class="modal-body">
                                        <form action="{{route('siswa.update',$s->nisn)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="">Nisn</label>
                                                <input type="number" class="form-control" name="nisn" value="{{ $s->nisn }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nis</label>
                                                <input type="number" class="form-control" name="nis" value="{{ $s->nis }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nama</label>
                                                <input type="text" class="form-control" name="nama" value=" {{ $s->nama }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Rombel</label>
                                                <select class="form-control" name="id_kelas">
                                                @foreach($rombel as $rombels)
                                                <option value="{{ $rombels->id }}"> {{ $rombels->kompetensi_keahlian }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Alamat</label>
                                                <input type="text" name="alamat" class="form-control" id="" value="{{ $s->alamat }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nomor Telpon</label>
                                                <input type="number" name="no_telp" class="form-control" value="{{ $s->no_telp }}" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Spp</label>
                                                <select class="form-control" name="id_spp">
                                                    @foreach($spp as $sp)
                                                    <option value="{{ $sp->id }}">{{ $sp->tahun }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                                
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