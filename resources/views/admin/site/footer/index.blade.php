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
                        <div class="card-header">
                            @if($isSet > 0)
                            @else
                            <a href="#" class="btn btn-info btn-round waves-effect waves-light m-1" data-toggle="modal"
                               data-target="#footersetmodal">Configure footer text</a>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="footersetTable" class="table table-bordered ">
                                    <thead>

                                    <th>Action</th>
                                    <th>About</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Twitter link</th>
                                    <th>Facebook link</th>
                                    <th>Instagram link</th>
                                    <th>Linkedin link</th>

                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Row-->
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade footersetmodal" id="footersetmodal">
        <div class="modal-dialog  modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Configure Footer text</h5>
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
                            <label for="about">About text</label>
                            <textarea name="about" id="summernoteEditor"  cols="10" rows="2" class="form-control form-control-rounded" required>

                        </textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email </label>
                            <input type="text" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact text</label>
                            <input type="text" name="contact" id="contact" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter link</label>
                            <input type="text" name="twitter" id=twitter" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook link</label>
                            <input type="text" name="facebook" id="facebook" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram text</label>
                            <input type="text" name="instagram" id="instagram" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="linkedin">Linkedin text</label>
                            <input type="text" name="linkedin" id="linkedin" class="form-control">
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

        var table = $('#footersetTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('footerSettingsIndex')}}",
            columns:[

                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'about', name: 'about'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data: 'contact', name: 'contact'},
                {data: 'twitter', name: 'twitter'},
                {data: 'facebook', name: 'facebook'},
                {data: 'instagram', name: 'instagram'},
                {data: 'linkedin', name: 'linkedin'},
            ],


        });




        function footerSettingsDelete(footerset_id) {
            if (confirm("Do you want to delete this Site Setting!")) {
                $.ajax({
                    url:'/footer/settings/delete',
                    method:'delete',
                    data:{
                        footerset_id:footerset_id,
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
                        $('#footersetTable').DataTable().ajax.reload();
                    }

                });  } else {
                txt = "You pressed Cancel!";
            }

        }



        $("#sitesettings_add").on("submit", function (event) {
            event.preventDefault();

            $(".imguploadoverlay").fadeIn();
            $.ajax({
                url: "/footer/settings/store",
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

        $(document).ready(function(){
            $(".alert").delay(5000).slideUp(300);
        });


    </script>


@endsection
