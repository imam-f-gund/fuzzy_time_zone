@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="modal fade" id="tambahDataPendapatan" tabindex="-1" aria-labelledby="tambahDataPendapatanLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahDataPendapatanLabel">Tambah Data Pendapatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('pendapatan') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="bulan">Bulan</label>
                                <select class="form-select" id="bulan" name="bulan">
                                    <option selected value="">Pilih bulan</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Febuari">Febuari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April ">April </option>
                                    <option value="Mei ">Mei </option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November ">November </option>
                                    <option value="Desember">Desember</option>

                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="tahun">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="2023">
                                <p class="mt-2 text-danger">* contoh : 2023</p>
                            </div>
                            <div class="form-group mb-2">
                                <label for="pendapatan">Pendapatan</label>
                                <input type="number" class="form-control" id="pendapatan" name="pendapatan" placeholder="20000000">
                                <p class="mt-2 text-danger">* contoh : 20000000</p>
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
                        <h5 class="modal-title" id="ubahDataPendapatanLabel">Ubah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('pendapatan') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="bulan">Bulan</label>
                                <select class="form-select" id="bulan" name="bulan">
                                    <option selected value="">Pilih bulan</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Febuari">Febuari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April ">April </option>
                                    <option value="Mei ">Mei </option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November ">November </option>
                                    <option value="Desember">Desember</option>

                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="tahun">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun">
                            </div>
                            <div class="form-group mb-2">
                                <label for="pendapatan">Pendapatan</label>
                                <input type="number" class="form-control" id="pendapatan" name="pendapatan">
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
                <h2 class="main-title my-auto">Data Pendapatan</h2>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#tambahDataPendapatan">
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
                                        <th>Bulan</th>
                                        <th>Tahun</th>
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
                                            <td>{{ $datas->bulan }}</td>
                                            <td>{{ $datas->tahun }}</td>
                                            <td>Rp.{{ number_format($datas->pendapatan, 0, ",", ".")}}</td>
                                            <td class="center">
                                                <button type="button" class="btn btn-warning btn-sm"
                                                    onclick="fungsiEdit('{{ $datas->id }}|{{ $datas->bulan }}|{{ $datas->tahun }}|{{ $datas->pendapatan }}')"
                                                    data-bs-toggle="modal" data-bs-target="#ubahDataPendapatan">
                                                    <i class="fa fa-edit">Edit</i>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm">
                                                    <a href="{{ url('detail/'.$datas['id']) }}">Detail</a>
                                                </button>

                                                <form action="{{ url('pendapatan/' . $datas->id) }}" class="d-inline"
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
                $('#ubahDataPendapatan form').attr('action', "{{ url('pendapatan') }}/" + data[0]);
                $('#ubahDataPendapatan .modal-body #bulan').val(data[1]);
                $('#ubahDataPendapatan .modal-body #tahun').val(data[2]);
                $('#ubahDataPendapatan .modal-body #pendapatan').val(data[3]);
                $('.selectpicker').selectpicker('refresh');
            }
        </script>
    @endsection
