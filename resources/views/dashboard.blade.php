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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div style="width: 100%; height: 350px" id='myDiv'></div>
            </div>
        </div>
    </div>

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
                    <h4 class="mt-2 mb-4">Pemesanan Kendaraan Terkini</h4>
                    <div class="row" style="margin-bottom: 10px">
                        <div class="pull-left ">
                            <nav role="navigation">
                                <ul class="ul-dropdown">
                                    <li class="firstli">
                                        <i class="material-icons"></i><a href="#">Export</a>
                                        <ul>
                                            <li><a href="#">Export CSV</a></li>
                                            <li><a href="#">Export Excel</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
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

<script src='https://cdn.plot.ly/plotly-2.8.3.min.js'></script>

<script>
    let total = @json($get_total);

    const trace2 = {
        x: @json($get_vehicle),
        y: @json($get_total),
        type: 'bar',
        name: 'Grafik Pemakaian',
        text: total.map(String),
        textposition: 'auto',
        marker:{
            color: ['#18C5FA', '#18C5FA', '#18C5FA']
        },
    };
    const data1 = [trace2];

    const layout1 = {
        title: 'Grafik Pemakaian Kendaraan',
        xaxis: {
            title: 'Nama Kendaraan'
        },
        yaxis: {
            title: 'Jumlah'
        }
    };

    Plotly.newPlot('myDiv', data1, layout1);
</script>


<script>
    $(document).ready(function() {
        $('#dataTable').dataTable({
            dom: "Blfrtip",
            buttons: [
                {
                    text: 'csv',
                    extend: 'csvHtml5',
                },
                {
                    text: 'excel',
                    extend: 'excelHtml5',
                },
            ],
            columnDefs: [{
                orderable: false,
                targets: -1
            }], 
            "language" : {
            "emptyTable": "Data Masih Kosong"
        }
        });
    });
</script>

<script>
    $("ul li ul li").click(function() {
    var i = $(this).index() + 1
    var table = $('#dataTable').DataTable();
    if (i == 1) {
        table.button('.buttons-csv').trigger();
    } else if (i == 2) {
        table.button('.buttons-excel').trigger();
    } else if (i == 3) {
        table.button('.buttons-pdf').trigger();
    } else if (i == 4) {
        table.button('.buttons-print').trigger();
    } 
});
</script>
@endsection