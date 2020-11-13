@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
                <div class="col-md-12">
                @if(session()->has('success'))
              <div class="alert alert-success">
                  {{ session()->get('success') }}
              </div>
              @elseif(session()->has('error'))
              <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
          @endif
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Site Settings
                        <a href="#" class="btn btn-info btn-round waves-effect waves-light m-1" data-toggle="modal"
                        data-target="#seomodal">Add Site Settings</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="siteSettings_table" class="table table-bordered ">
                                <thead>
                               
                                    <th>Action</th>
                                    <th>Logo</th>
                                    <th>Loading Icon</th>
                                    <th>Favicon</th>
                                    <th>Footer Text</th>
                                    <th>Bank details</th>
                                    <th>Paypal Client Id </th>
                                    <th>Paypal Client Secret</th>
                                    <th>Beat Playtime</th>
                                
                                </thead>
                                 <tbody>
                                    
                                </tbody> 
                                <tfoot>
                                
                                    <th>Action</th>
                                    <th>Logo</th>
                                    <th>Loading Icon</th>
                                    <th>Favicon</th>
                                    <th>Footer Text</th>
                                    <th>Bank details</th>
                                    <th>Paypal Client Id </th>
                                    <th>Paypal Client Secret</th>
                                    <th>Beat Playtime</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Row-->
    </div>
</div>



<!-- Modal -->
<div class="modal fade seomodal" id="seomodal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-star"></i> Add Site Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="overlay" style="display:none;" class="imguploadoverlay">
                    <div class="spinner"></div>
                    <br />
                    Saving...
                </div>
                <form id="sitesettings_add" method="POST" >
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
                        <input type="text" name="footer_text" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title">Paypal Client Id</label>
                        <input type="text" name="client_id" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title">Paypal Secret</label>
                        <input type="text" name="paypal_secret" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title">Beat Playtime in seconds</label>
                        <input type="number" name="beatplaytime" id="" class="form-control">
                    </div>
                 
                    <div class="form-group">
                        <label for="description">Bank Details</label>
                        <textarea name="bank_details" id="summernoteEditor"  cols="10" rows="3" class="form-control form-control-rounded">

                        </textarea>
                    </div>
                  
                  
                  
                 


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow-primary btn-round px-5"><i
                                class="icon-checkbox3"></i> Save</button>
                    </div>
                </form>
            </div>
  
        </div>
    </div>
</div>

<!-- Large Size Modal -->

<script>

        var table = $('#siteSettings_table').DataTable({
        processing: true,
        serverSide: true,    
        ajax: "{{ route('siteSettingsIndex')}}",
        columns:[

        {data: 'action', name: 'action', orderable: false, searchable: false},
        {data:'logo',name:'logo',
                      render: function(data, type, full, meta){
                      return "<img src={{ URL::to('') }}/Logos/"+data+ " width='70' class='img-thumbnail' />" ; },orderable: false},
        {data:'loading_icon',name:'loading_icon',
                      render: function(data, type, full, meta){
                      return "<img src={{ URL::to('') }}/Loading_Icons/"+data+ " width='70' class='img-thumbnail' />" ; },orderable: false},
        {data:'favicon',name:'favicon',
                      render: function(data, type, full, meta){
                      return "<img src={{ URL::to('') }}/Favicon/"+data+ " width='70' class='img-thumbnail' />" ; },orderable: false},
        {data: 'footer_text', name: 'footer_text'},
        {data: 'bank_details', name: 'bank_details'},
        {data: 'paypal_client_id', name: 'paypal_client_id'},
        {data: 'paypal_secret', name: 'paypal_secret'},
        {data: 'beat_time', name: 'beat_time'},
        ],
       

        });




   function sitesettingsDelete(siteSettings_id) {
    if (confirm("Do you want to delete this Site Setting!")) {
        $.ajax({
           url:'/sitesettings/destroy',
           method:'delete',
           data:{
               siteSettings_id:siteSettings_id,
                 _token: "{{ csrf_token() }}",
           },
           success:function(data){
               console.log('Deleted ');
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
             $('#siteSettings_table').DataTable().ajax.reload();
           }

       });  } else {
    txt = "You pressed Cancel!";
  }
    
    }



    $("#sitesettings_add").on("submit", function (event) {
        event.preventDefault();

        $(".imguploadoverlay").fadeIn();
        $.ajax({
            url: "/sitesettings/store",
            method: "POST",
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

                }

                $('#seomodal').modal('hide');
                $('#siteSettings_table').DataTable().ajax.reload();
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
    
     $(document).ready(function(){
        $(".alert").delay(5000).slideUp(300);
      });

   
</script>


@endsection