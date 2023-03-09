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
                <form action="{{route('spp.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Tahun</label>
                        <input type="number" class="form-control" name="tahun" placeholder="Masukan Tahun">
                    </div>
                    <div class="form-group">
                        <label for="">Nominal</label>
                        <input type="number" class="form-control" name="nominal" placeholder="Masukan Nominal">
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
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambah">Tambah Spp</button>
            {{-- <h3 class="m-0 font-weight-bold text-secondary">Data Spp</h3> --}}

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Nominal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($spp as $s)
                        <tr>
                            <td>{{$s->tahun}}</td>
                            <td>Rp{{number_format($s->nominal, 2,",",".") }}</td>
                            <td>
                                <form action="{{route('spp.destroy', $s->id)}}" method="POST" onsubmit="return confirm('Yakin Hapus {{ $s->tahun }} ??')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal2{{ $s->id }}" >Edit</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="modal2{{ $s->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Spp</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>  
                                <div class="modal-body">
                                    <form action="{{route('spp.update',$s->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="">Tahun</label>
                                            <input type="number" class="form-control" name="tahun" value="{{ $s->tahun }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nominal</label>
                                            <input type="number" class="form-control" name="nominal" value="{{ $s->nominal }}">
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