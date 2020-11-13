@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
 <div class="col-md-6">
@foreach ($footerSettings as $footerSetting)
 <form id="sitesettings_add" enctype="multipart/form-data" >
    @csrf
     <input type="hidden" name="setting_id" id="setting_id" value="{{$footerSetting->id}}">
     <div class="form-group">
         <label for="about">About text</label>
         <textarea name="about" id="summernoteEditor"  cols="10" rows="2" class="form-control form-control-rounded" required>
            {{$footerSetting->about}}
                        </textarea>
     </div>
     <div class="form-group">
         <label for="phone">Phone</label>
         <input type="text" name="phone" id="phone" class="form-control" value="{{$footerSetting->phone}}" required>
     </div>
     <div class="form-group">
         <label for="email">Email </label>
         <input type="text" name="email" id="email" class="form-control" value="{{$footerSetting->email}}" required>
     </div>
     <div class="form-group">
         <label for="contact">Contact text</label>
         <input type="text" name="contact" id="contact" class="form-control" value="{{$footerSetting->contact}}" required>
     </div>
     <div class="form-group">
         <label for="twitter">Twitter link</label>
         <input type="text" name="twitter" id=twitter" class="form-control" value="{{$footerSetting->twitter}}">
     </div>
     <div class="form-group">
         <label for="facebook">Facebook link</label>
         <input type="text" name="facebook" id="facebook" class="form-control" value="{{$footerSetting->facebook}}">
     </div>
     <div class="form-group">
         <label for="instagram">Instagram text</label>
         <input type="text" name="instagram" id="instagram" class="form-control" value="{{$footerSetting->instagram}}">
     </div>
     <div class="form-group">
         <label for="linkedin">Linkedin text</label>
         <input type="text" name="linkedin" id="linkedin" class="form-control" value="{{$footerSetting->linkedin}}">
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
    var setting_id =$('#setting_id').val();

    $("#sitesettings_add").on("submit", function (event) {
        event.preventDefault();

        $(".imguploadoverlay").fadeIn();
        $.ajax({
            url: "/footer/settings/update/"+setting_id,
            method: "post",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success:function(data){
                console.log(data);
                $(".imguploadoverlay").fadeOut();
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
                    $('#footersetmodal').modal('hide');
                    $('#footersetTable').DataTable().ajax.reload();

                }


            },
            // error: function () {
            // Lobibox.notify("error", {
            //     pauseDelayOnHover: true,
            //     continueDelayOnInactiveTab: false,
            //     position: "top right",
            //     icon: "fa fa-times-circle",
            //     msg: "Something went wrong!Please try again",
            // });
            // console.log("error");
            // },
        });
    });
</script>
@endsection
