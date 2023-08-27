@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="modal fade" id="tambahDataDetail" tabindex="-1" aria-labelledby="tambahDataDetailLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahDataDetailLabel">Tambah Detail Pendapatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('detail') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="pendapatan_id" value="{{$pendapatan->id}}">
                            <div class="form-group mb-2">
                                <label for="ukuran">Ukuran</label>
                                <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="S,M,L,XL,XXL">
                            </div>

                            <div class="form-group mb-2">
                                <label for="warna">Warna</label>
                                <input type="text" class="form-control" id="warna" name="warna" placeholder="Merah">
                            </div>
                            <div class="form-group mb-2">
                                <label for="penjualan">Data Penjualan</label>
                                <input type="number" class="form-control" id="penjualan" name="penjualan" placeholder="35">
                            </div>
                            <div class="form-group mb-2">
                                <label for="jenis_kaos">Jenis Kaos</label>
                                <input type="text" class="form-control" id="jenis_kaos" name="jenis_kaos" placeholder="Pendek,Panjang">
                            </div>
                            <div class="form-group mb-2">
                                <label for="pendapatan">Pendapatan</label>
                                <input type="number" class="form-control" id="pendapatan" name="pendapatan" placeholder="20100000">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ubahDataPendapatan" tabindex="-1" aria-labelledby="ubahDataPendapatanLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ubahDataPendapatanLabel">Ubah Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('pendapatan') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                        
                            <div class="form-group mb-2">
                                <label for="ukuran">Ukuran</label>
                                <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="S">
                            </div>

                            <div class="form-group mb-2">
                                <label for="warna">Warna</label>
                                <input type="text" class="form-control" id="warna" name="warna" placeholder="Merah">
                            </div>
                            <div class="form-group mb-2">
                                <label for="penjualan">Data Penjualan</label>
                                <input type="number" class="form-control" id="penjualan" name="penjualan" placeholder="35">
                            </div>
                            <div class="form-group mb-2">
                                <label for="jenis_kaos">Jenis Kaos</label>
                                <input type="text" class="form-control" id="jenis_kaos" name="jenis_kaos" placeholder="Pendek">
                            </div>
                            <div class="form-group mb-2">
                                <label for="pendapatan">Pendapatan</label>
                                <input type="number" class="form-control" id="pendapatan" name="pendapatan" placeholder="20100000">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <h2 class="main-title my-auto">Data Pendapatan {{$pendapatan->bulan}} - {{$pendapatan->tahun}}</h2>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#tambahDataDetail">
                    Tambah
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-stripped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Ukuran</th>
                                        <th>Warna</th>
                                        <th>Penjualan</th>				
                                        <th>Jenis Kaos</th>
                                        <th>Pendapatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $datas)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $datas->ukuran }}</td>
                                            <td>{{ $datas->warna }}</td>
                                            <td>{{ $datas->penjualan }}</td>
                                            <td>{{ $datas->jenis_kaos }}</td>
                                            <td>Rp.{{ number_format($datas->pendapatan, 0, ",", ".")}}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm"
                                                    onclick="fungsiEdit('{{ $datas->id }}|{{ $datas->ukuran }}|{{ $datas->warna }}|{{ $datas->penjualan }}|{{ $datas->jenis_kaos }}|{{ $datas->pendapatan }}')"
                                                    data-bs-toggle="modal" data-bs-target="#ubahDataPendapatan">
                                                    <i class="fa fa-edit">Edit</i>
                                                </button>
                                                

                                                <form action="{{ url('detail/' . $datas->id) }}" class="d-inline"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                        <i class="fa fa-trash">Hapus</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            function fungsiEdit(data) {
                var data = data.split('|');
                console.log(data);
                $('#ubahDataPendapatan form').attr('action', "{{ url('detail') }}/" + data[0]);
                $('#ubahDataPendapatan .modal-body #ukuran').val(data[1]);
                $('#ubahDataPendapatan .modal-body #warna').val(data[2]);
                $('#ubahDataPendapatan .modal-body #penjualan').val(data[3]);
                $('#ubahDataPendapatan .modal-body #jenis_kaos').val(data[4]);
                $('#ubahDataPendapatan .modal-body #pendapatan').val(data[5]);
                $('.selectpicker').selectpicker('refresh');
            }
        </script>
    @endsection
