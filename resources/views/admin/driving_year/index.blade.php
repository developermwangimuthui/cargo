@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i>Driving Year
                        <a href="#" class="btn btn-info btn-round waves-effect waves-light m-1" data-toggle="modal"
                            data-target="#categorymodal">Add Driving Year</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="driving_year_table" class="table table-bordered ">
                                <thead>

                                    <th>Driving Year</th>
                                    <th>Action</th>

                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>


                                    <th>Driving Year</th>
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
<div class="modal fade servicemodal" id="categorymodal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Add Driving Year</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="product_type_add" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Driving Year</label>
                        <input type="text" class="form-control form-control-rounded" id="title"
                            placeholder="Enter Driving Year" name="driving_year">
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
    var table = $('#driving_year_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('driving.year')}}",
        columns:[
        {data: 'driving_years', name: 'driving_years'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs:[

        ]

        });

   function drivingyeardelete(driving_years_id) {
    if (confirm("Do you want to delete this Driving Year !")) {
        $.ajax({
           url:'/driving/year/destroy/',
           method:'delete',
           data:{
               driving_years_id:driving_years_id,
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
             $('#driving_year_table').DataTable().ajax.reload();
           }

       });  } else {
    txt = "You pressed Cancel!";
  }

    }



    $("#product_type_add").on("submit", function (event) {
        event.preventDefault();
        // console.log('aye');
        $.ajax({
            url: "/driving/year/store",
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
                $('#categorymodal').modal('hide');
                $('#driving_year_table').DataTable().ajax.reload();
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
