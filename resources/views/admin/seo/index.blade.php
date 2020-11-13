@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Seo
                        <a href="#" class="btn btn-info btn-round waves-effect waves-light m-1" data-toggle="modal"
                        data-target="#seomodal">Add Seo</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="seo_table" class="table table-bordered ">
                                <thead>
                               
                                    <th>Action</th>
                                    <th>Page Title</th>
                                    <th>Seo Title</th>
                                    <th>Meta Description</th>
                                    <th>Meta Keywords</th>
                                    <th>Seo Other</th>
                                
                                </thead>
                                 <tbody>
                                    
                                </tbody> 
                                <tfoot>
                                
                                    <th>Action</th>
                                    <th>Page Title</th>
                                    <th>Seo Title</th>
                                    <th>Meta Description</th>
                                    <th>Meta Keywords</th>
                                    <th>Seo Other</th>
                                 
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
                <h5 class="modal-title"><i class="fa fa-star"></i> Add Seo</h5>
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
                <form id="seo_add" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="title">Page Title</label>
                        <input type="text" name="page_title" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title">Seo Title</label>
                        <input type="text" name="seo_title" id="" class="form-control">
                    </div>
                 
                    <div class="form-group">
                        <label for="description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" cols="10" rows="3" class="form-control form-control-rounded">

                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Meta Keywords</label>
                        <textarea name="meta_keyword" id="meta_keywords" cols="10" rows="3" class="form-control form-control-rounded">

                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Other Seo Tags</label>
                        <textarea name="seo_other"  cols="10" rows="3" class="form-control form-control-rounded">

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

        var table = $('#seo_table').DataTable({
        processing: true,
        serverSide: true,    
        ajax: "{{ route('seo.index')}}",
        columns:[

        {data: 'action', name: 'action', orderable: false, searchable: false},
        {data: 'page_title', name: 'page_title'},
        {data: 'seo_title', name: 'seo_title'},
        {data: 'meta_description', name: 'meta_description'},
        {data: 'meta_keyword', name: 'meta_keyword'},
        {data: 'seo_other', name: 'seo_other'},
        ],
        columnDefs:[
       
        ]

        });




   function seodelete(seo_id) {
    if (confirm("Do you want to delete the SEO!")) {
        $.ajax({
           url:'/seo/destroy/',
           method:'delete',
           data:{
               seo_id:seo_id,
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
             $('#seo_table').DataTable().ajax.reload();
           }

       });  } else {
    txt = "You pressed Cancel!";
  }
    
    }



    $("#seo_add").on("submit", function (event) {
        event.preventDefault();

        $(".imguploadoverlay").fadeIn();
        $.ajax({
            url: "/seo/store",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success:function(data){

                $(".imguploadoverlay").fadeOut();
            console.log("success");
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
                $('#seo_table').DataTable().ajax.reload();
            },
            error: function () {
            Lobibox.notify("error", {
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: "top right",
                icon: "fa fa-times-circle",
                msg: "Something went wrong!Please try again",
            });
            console.log("error");
            },
        });
    });
   
</script>


@endsection