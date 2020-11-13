@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
 <div class="col-md-6">
@foreach ($sitesettings as $sitesetting)
 <form id="sitesettings_add" method="POST" action="{{route('siteSettingsUpdate',$sitesetting->id)}}" enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
        <label for="title">Site Logo</label>
        <input type="file" name="logo" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="title">Loading Icon</label>
        <input type="file" name="loading_icon" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="title">Favicon </label>
        <input type="file" name="favicon" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="title">Footer text</label>
        <input type="text" name="footer_text" id="" class="form-control" value="{{$sitesetting->footer_text}}">
    </div>
    <div class="form-group">
        <label for="title">Paypal Client Id</label>
    <input type="text" name="client_id" id="" class="form-control" value="{{$sitesetting->paypal_client_id}}">
    </div>
    <div class="form-group">
        <label for="title">Paypal Secret</label>
        <input type="text" name="paypal_secret" id="" class="form-control" value="{{$sitesetting->paypal_secret}}">
    </div>
    <div class="form-group">
        <label for="title">Beat Playtime in seconds</label>
        <input type="number" name="beatplaytime" id="" class="form-control" value="{{$sitesetting->beat_time}}">
    </div>
 
    <div class="form-group">
        <label for="description">Bank Details</label>
        <textarea name="bank_details" id="summernoteEditor"  cols="10" rows="3" class="form-control form-control-rounded">
{{$sitesetting->bank_details}}
        </textarea>
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



var seo_id =$('#seo_id').val();
    $("#seo_add").on("submit", function (event) {
        event.preventDefault();
        console.log(seo_id);
        $.ajax({
            url: '/seo/update/'+seo_id,
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",

            success:function(data){
               if (data.errors) {
                    Lobibox.notify("error", {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        icon: "fa fa-times-circle",
                        msg: data.message,
                    });
                }
                if (data.success) {
                    Lobibox.notify("success", {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        icon: "fa fa-check-circle", //path to image
                        msg: data.message,
                     });

                }
            },
            error:function (data) {
            Lobibox.notify("error", {
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: "top right",
                icon: "fa fa-times-circle",
                msg: "Something went wrong",
            });

            },
    });
    });





function deletepic(photo_id) {
        $.ajax({
url:'/service/photo/destroy',
method:'Delete',
data:{
    photo_id:photo_id,
    _token: "{{ csrf_token() }}",
},
success:function(data){
    if (data.errors) {
                    Lobibox.notify("error", {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        icon: "fa fa-times-circle",
                        msg: data.message,
                    });
                }
                if (data.success) {
                    Lobibox.notify("success", {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        icon: "fa fa-check-circle", //path to image
                        msg: data.message,
                     });

                }
location.reload();
},
error:function(){
    console.log('error');

}
        });
        
    }
</script>
@endsection