@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Keys
                        <a href="#" class="btn btn-info btn-round waves-effect waves-light m-1" data-toggle="modal"
                            data-target="#keymodal">Add Key</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="key_table" class="table table-bordered ">
                                <thead>

                                    <th>Key Name</th>
                                    <th>Action</th>

                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>


                                    <th>Key Name</th>
                                    <th>Action</th>

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
<div class="modal fade servicemodal" id="keymodal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Add Key</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="key_add" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Key Name</label>
                        <input type="text" class="form-control form-control-rounded" id="title"
                            placeholder="Enter Key Name" name="key">
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
    var table = $('#key_table').DataTable({
        processing: true,
        serverSide: true,    
        ajax: "{{ route('key.index')}}",
        columns:[
        {data: 'key', name: 'key'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs:[
       
        ]

        });

   function keydelete(key_id) {
    if (confirm("Do you wantto delete this Key!")) {
        $.ajax({
           url:'/key/destroy/',
           method:'delete',
           data:{
               key_id:key_id,
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

                     console.log(data.success);
                }
             $('#key_table').DataTable().ajax.reload();
           }

       });  } else {
    txt = "You pressed Cancel!";
  }
   
    }



    $("#key_add").on("submit", function (event) {
        event.preventDefault();
        // console.log('aye');
        $.ajax({
            url: "/key/store",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                console.log(data);
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

                     console.log(data.success);
                }
                $('#keymodal').modal('hide');
                $('#key_table').DataTable().ajax.reload();
            },
            error: function () {
            Lobibox.notify("error", {
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: "top right",
                icon: "fa fa-times-circle",
                msg: "Something went wrong",
            });
            console.log("error");
                                },
        });
    });
   
</script>


@endsection