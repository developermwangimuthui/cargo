@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
 <div class="col-md-6">
@foreach ($product_sizes as $product_size)
 <form id="service_add" method="POST" enctype="multipart/form-data" action="{{route('product.size.update',$product_size->id)}}" >
    @csrf
    <div class="form-group">
        <label for="title">Product Size</label>
        <input type="text" class="form-control form-control-rounded" id="title"
    placeholder="Enter Category Name" name="product_size" value="{{$product_size->product_sizes}}">
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
