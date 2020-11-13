@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
 <div class="col-md-6">
@foreach ($locations as $location)
 <form id="service_add" method="POST" enctype="multipart/form-data" action="{{route('location.update',$location->id)}}" >
    @csrf
    <div class="form-group">
        <label for="title">Location</label>
        <input type="text" class="form-control form-control-rounded" id="title"
    placeholder="Enter Location Name" name="location" value="{{$location->location}}">
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