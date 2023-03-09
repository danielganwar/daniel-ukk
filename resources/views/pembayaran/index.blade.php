@extends('layouts.master')
@section('content')
   
{{-- <div class="container-fluid"> --}}
{{-- <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pembayaran Spp</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6> --}}
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambah">Tambah</button>
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
                            @foreach ($pembayaran as $pm)
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
                    <form action="{{route('pembayaran.store')}}" method="post">
                        @csrf

                        @if ($siswa->count() == 0)
                            <div class="form-group">
                                <input type="text" class="form-control bg-danger text-white"
                                    value=" Belum ada siswa satupun :( , Silahkan isi terlebih dahulu ">
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="">Nisn</label>
                        <select class="form-control" name="nisn" id="nisn">
                            <option disabled selected option value="">- - - - - - - - - - - - - - - - - - Pilih - - - - - - - - - - - - - - - - - - -</option>
                            @foreach($siswa as $s)
                            <option value="{{ $s->nisn }}">{{$s->nisn}} | {{$s->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Bulan</label>
                        <select class="form-control" name="bulan_dibayar" id="berapa">
                            <option value="1">1 Bulan</option>
                            <option value="2">2 Bulan</option>
                            <option value="3">3 Bulan</option>
                            <option value="4">4 Bulan</option>
                            <option value="5">5 Bulan</option>
                            <option value="6">6 Bulan</option>
                            <option value="7">7 Bulan</option>
                            <option value="8">8 Bulan</option>
                            <option value="9">9 Bulan</option>
                            <option value="10">10 Bulan</option>
                            <option value="11">11 Bulan</option>
                            <option value="12">12 Bulan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Spp</label>
                        <input type="text" id="spp" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nominal</label>
                        <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal" readonly>
                    </div>
                    <div class="form-group" id="trk">
                        <label for="">Terakhir Bayar</label>
                        <input type="text" class="form-control" name="akhir" id="akhir" placeholder="Terakhir Bayar" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Bayar</label>
                        <input type="number" class="form-control" name="jumlah_bayar" id="jumlah_bayar">
                    </div>
                    <div class="form-group">
                        <label for="">Kembalian</label>
                        <input type="text" class="form-control" name="kembalian" id="kembalian" placeholder="Kembalian" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ]
        })
    });
</script>

<script>
    $(document).ready(function(){
        $('#').each((_i, e) => {
        var $e = $(e);
        $e.select2({
            tags: true,
            dropdownParent: $e.parent()
        });
    });
});
</script>

<script>
    $('#nisn').on('change', function(){
        var nisn = $('#nisn').val();
        var berapa = $('#berapa').val();
        $('#trk').removeClass('d-none');
        $.ajax({
            url: "{{url('pembayaran/getData/')}}" + "/" + nisn + "/" + berapa,
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data);
                $('#spp').val(data['nominal']);
                $('#akhir').val(data['bulan']);
            }
        });

        $('#berapa').on('change', function() {
            var spp = $('#spp').val();
            var bayar = $(this).val();
            var total = spp * bayar;
            $('#nominal').val(total);

        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#nominal, #jumlah_bayar").keyup(function() {
            var harga  = $("#nominal").val();
            var jumlah = $("#jumlah_bayar").val();
            
            var total = parseInt(jumlah) - parseInt(harga);
            $("#kembalian").val(total);
        });
    });
</script>

<script>
    $('#jumlah_bayar').keyup(function(){
        var sanitized = $(this).val().replace(/[^0-9]/g, '');
        
        $(this).val(sanitized);
    });
</script>
@endsection