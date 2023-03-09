@extends('layouts.master')
@section('content')


        {{-- MODAL TAMBAH --}}
        <div class="modal fade" id="modalTambahRombel" tabindex="-1" aria-labelledby="modalTambahRombel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>  
            <div class="modal-body">
                <form action="{{route('rombel.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Kelas</label>
                        <input type="text" class="form-control" name="nama_rombel" placeholder="Masukan Nama Kelas">
                    </div>
                    <div class="form-group">
                        <label for="">Kompetensi Keahlian</label>
                        <input type="text" class="form-control" name="kompetensi_keahlian" placeholder="Masukan Nama Kompetensi Keahlian">
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
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahRombel">Tambah Rombel</button>
            {{-- <h3 class="m-0 font-weight-bold text-secondary">Data Rombel</h3> --}}

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rombel as $r)
                        <tr>
                            <td>{{$r->nama_rombel}}</td>
                            <td>{{$r->kompetensi_keahlian}}</td>
                            <td>
                                <form action="{{route('rombel.destroy', $r->id)}}" method="POST" onsubmit="return confirm('Yakin Hapus {{ $r->kompetensi_keahlian }} ??')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal2{{ $r->id }}" >Edit</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="modal2{{ $r->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Rombel</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>  
                                <div class="modal-body">
                                    <form action="{{route('rombel.update',$r->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="">Nama Rombel</label>
                                            <input type="text" class="form-control" name="nama_rombel" value="{{ $r->nama_rombel }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kompetensi Keahlian</label>
                                            <input type="text" class="form-control" name="kompetensi_keahlian" value="{{ $r->kompetensi_keahlian }}">
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