@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
 <div class="col-md-6">
@foreach ($license_plate_colors as $license_plate_color)
<form id="service_add" method="POST" enctype="multipart/form-data" action="{{route('license.plate.color.update',$license_plate_color->id)}}" >
@csrf
    <div class="form-group">
        <label for="title">Edit License Plate Color</label>
        <input type="text" class="form-control form-control-rounded" id="title"
    placeholder="Enter License Plate Color" name="license_plate_color" value="{{$license_plate_color->license_plate_colors}}">
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary shadow-primary btn-round px-5"><i
                class="icon-checkbox3"></i> Save</button>
    </div>
</form>
@endforeach

    </div>

</div>
</div>
<script>

function deletepic(photo_id) {
        $.ajax({
url:'/photo/destroy',
method:'Delete',
data:{
    photo_id:photo_id,
    _token: "{{ csrf_token() }}",
},
success:function(){
location.reload();
},
error:function(){
    console.log('error');

}
        });

    }
</script>
@endsection
