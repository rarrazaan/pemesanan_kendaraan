@extends('layout.main')
@section('content')
<div class="section-header">
    <div class="aligns-items-center d-inline-block">
        <a href="{{ url('dashboard') }}">
            <i class="h5 fa fa-arrow-left"></i>
        </a> &nbsp; &nbsp;
        <h1>{{ $title }}</h1>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger alert-dismissible show fade" style="padding-bottom: 2px">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ url('addBook') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="section-body">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Masukkan Form Data Booking</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Peminjam</label>
                        <div class="col-sm-10">
                            <select id='peminjam_id' name='peminjam_id' class="form-select">
                                <option value='0'>-- Pilih Peminjam --</option>
                                @foreach($peminjamData['data'] as $peminjam)
                                <option value='{{ $peminjam->id }}'>{{ $peminjam->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Approver</label>
                        <div class="col-sm-10">
                            <div class="col-sm-10">
                                <select id='approver_id' name='approver_id' class="form-select">
                                    <option value='0'>-- Pilih Approver --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Tanggal Mulai Pesanan</label>
                            <input id="start_book" type="date" class="form-control" name="start_book">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Tanggal Selesai Pesanan</label>
                            <input id="end_book" type="date" class="form-control" name="end_book">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Driver</label>
                            <div class="col-sm-10">
                                <div class="col-sm-10">
                                    <select id='driver_id' name='driver_id' class="form-select">
                                        <option value='0'>-- Pilih Driver --</option>
                                        @foreach($drvData['data'] as $driver)
                                        <option value='{{ $driver->id }}'>{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Driver</label>
                            <div class="col-sm-10">
                                <div class="col-sm-10">
                                    <select id='vehicle_id' name='vehicle_id' class="form-select">
                                        <option value='0'>-- Pilih Kendaraan --</option>
                                        @foreach($vhcData['data'] as $vehicle)
                                        <option value='{{ $vehicle->id }}'>{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary float-right">Tambah Data</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type='text/javascript'>
    $(document).ready(function(){
 
      $('#peminjam_id').change(function(){
         // Department id
         var id = $(this).val();
 
         // Empty the dropdown
         $('#approver_id').find('option').not(':first').remove();
 
         // AJAX request 
         $.ajax({
           url: 'getApprover/'+id,
           type: 'get',
           dataType: 'json',
           success: function(response){
                var len = 0;
                if(response['data'] != null){
                    len = response['data'].length;
                }
 
                if(len > 0){
                    // Read data and create <option >
                    for(var i=0; i<len; i++){
                        var id = response['data'][i].id;
                        var name = response['data'][i].name;
                        var option = "<option value='"+id+"'>"+name+"</option>"; 
                        $("#approver_id").append(option); 
                    }
                }
           }
        });
      });
    });
</script>

<script type='text/javascript'>
    $(document).ready(function(){
 
      $('#end_book').change(function(){
         // Department id
         var start_book = $('#start_book').val();
         var end_book = $('#end_book').val();

        if (start_book>end_book){
            alert("Cek kembali tanggal pemesanan")
        }
    });
});
</script>
{{-- <script type='text/javascript'>
    $(document).ready(function(){
 
      $('#end_book').change(function(){
         // Department id
         var start_book = $('#start_book').val();
         var end_book = $('#end_book').val();

         var start_date = new Date(start_book).getTime();
         var end_date = new Date(end_book).getTime();

        //  alert(end_date);

         // Empty the dropdown
         $('#driver_id').find('option').not(':first').remove();
 
         // AJAX request 
         $.ajax({
        //     url: '/getDriver',
        //    method: 'post',
        //    data:{start:start_date, end:end_date},
           url: `{{ url('getDriver') }}/${start_date}/${end_date}`,
type: 'get',
dataType: 'json',
success: function(response){
var len = 0;
if(response['data'] != null){
len = response['data'].length;
}

if(len > 0){
// Read data and create <option>
    for(var i=0; i<len; i++){ var id=response['data'][i].id; var name=response['data'][i].name; var
        option="<option value='" +id+"'>"+name+"</option>";
$("#driver_id").append(option);
}
}
}
}).fail(function() {
alert('Fail!');
});
});
});
</script> --}}
@endsection