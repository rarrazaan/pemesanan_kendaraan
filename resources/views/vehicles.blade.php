@extends('layout.main')
@section('content')
<div class="section-header">
    <h1>{{ $title }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-2 mb-4">Daftar Kendaraan</h4>
                    <div class="table-responsive">
                        <table id="dataTable" class="table-bordered table-md table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Jenis Angkut</th>
                                    <th>Pemilik</th>
                                    <th>Konsumsi_BBM</th>
                                    <th>Jadwal Service</th>
                                    <th>Riwayat Pemakaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $key => $ctr)
                                <tr>
                                    <td>{{ $ctr->id }}</td>
                                    <td>{{ $ctr->name }}</td>
                                    <td>{{ $ctr->jenis_angkut }}</td>
                                    <td>{{ $ctr->pemilik }}</td>
                                    <td>{{ $ctr->konsumsi_BBM }}</td>
                                    <td>{{ date("F jS, Y", strtotime($ctr->jadwal_service)) }}</td>
                                    <td>{{ $ctr->riwayat_pemakaian }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection