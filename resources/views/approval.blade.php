@extends('layout.main')
@section('content')
<div class="section-header">
    <h1>{{ $title }}</h1>
</div>
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        {{ session()->get('message') }}
    </div>
</div>
@endif
<div class="section-body">
    <style>
        .zoom {
            transition: transform .2s;
            margin: 0 auto;
        }

        .zoom:hover {
            transform: scale(2);
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-2 mb-4">Pemesanan Kendaraan Yang Membutuhkan Persetujuan</h4>
                    <div class="table-responsive">
                        <table id="dataTable" class="table-bordered table-md table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Peminjam</th>
                                    <th>Approver</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Kendaraan</th>
                                    <th>Driver</th>
                                    <th style="width: 15%">Status</th>
                                    <th style="width: 15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking as $key => $ctr)
                                <tr>
                                    <td>{{ $ctr->id }}</td>
                                    <td>{{ $ctr->peminjam->name }}</td>
                                    <td>{{ $ctr->approver->name }}</td>
                                    <td>{{ date("F jS, Y", strtotime($ctr->start_book)) . ' - ' . date("F jS, Y", strtotime($ctr->end_book)) }}
                                    </td>
                                    <td>{{ $ctr->vehicle->name }}</td>
                                    <td>{{ $ctr->driver->name }}</td>

                                    @if ($ctr->need_approval == False and $ctr->is_approved == False)
                                    <td class="badge badge-danger" style="margin: 10%">Rejected</td>
                                    @elseif ($ctr->need_approval == False and $ctr->is_approved == True)
                                    <td class="badge badge-success" style="margin: 10%">Approved</td>
                                    @else
                                    <td class="badge badge-secondary" style="margin: 10%">Need Approval</td>
                                    @endif

                                    @if ($ctr->need_approval == True)
                                    <td>
                                        <a href="/approve/{{ $ctr->id }}" class="btn btn-icon btn-lg btn-success"
                                            onclick="return confirm('Are you sure?')"><i class="fas fa-check"></i></a>
                                        <a href="/decline/{{ $ctr->id }}" class="btn btn-icon btn-lg btn-danger"
                                            onclick="return confirm('Are you sure?')"><i class="fas fa-times"></i></a>
                                    </td>
                                    @else
                                    <td>
                                        <div class="btn btn-icon btn-lg btn-light"><i class="fas fa-star"></i></div>
                                    </td>
                                    @endif
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