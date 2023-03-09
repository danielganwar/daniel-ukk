@extends('layouts.master')
@section('content')

            {{-- MODAL TAMBAH --}}
            <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>  
            <div class="modal-body">
                <form action="{{route('petugas.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Petugas</label>
                        <input type="text" class="form-control" name="nama_petugas" placeholder="Masukan Nama Petugas">
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Masukan Username">
                    </div>
                    <div class="form-group">
                        <label for="">Tingkatan</label>
                        <select name="level" class="form-control" id="">
                            <option disabled selected option value="">Pilih</option>
                            <option value="1">Admin</option>
                            <option value="2">Petugas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukan Password">
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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambah">Tambah Petugas</button>
                {{-- <h3 class="m-0 font-weight-bold text-secondary">Data Petugas</h3> --}}

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Petugas</th>
                                <th>Username</th>
                                <th>Tingkatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($petugas as $p)
                            <tr>
                                <td>{{$p->nama_petugas}}</td>
                                <td>{{$p->username}}</td>
                                <td>{{$p->level}}</td>
                                <td>
                                    <form action="{{route('petugas.destroy', $p->id)}}" method="POST" onsubmit="return confirm('Yakin akan di hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal2{{ $p->id }}" >Edit</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                {{-- MODAL EDIT --}}
                            <div class="modal fade" id="modal2{{ $p->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit petugas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>  
                                <div class="modal-body">
                                    <form action="{{route('petugas.update',$p->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="">Nama Petugas</label>
                                            <input type="text" class="form-control" name="nama_petugas" value="{{ $p->nama_petugas }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input type="text" class="form-control" name="username" value="{{ $p->username }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tingkatan</label>
                                            <select name="level" class="form-control" id="">
                                                <option disabled selected option value="">Pilih</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Petugas</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" class="form-control" name="password" value="{{ $p->password }}">
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

