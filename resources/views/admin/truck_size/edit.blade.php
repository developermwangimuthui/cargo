@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
 <div class="col-md-6">
@foreach ($truck_sizes as $truck_size)
 <form id="service_add" method="POST" enctype="multipart/form-data" action="{{route('truck.size.update',$truck_size->id)}}" >
    @csrf
    <div class="form-group">
        <label for="title">Truck Size</label>
        <input type="text" class="form-control form-control-rounded" id="title"
    placeholder="Enter Packaging Style" name="truck_size" value="{{$truck_size->truck_sizes}}">
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
