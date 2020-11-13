@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header">
                        <i class="fa fa-table"></i> Music
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="music_table" class="table table-bordered ">
                                <thead>

                                        <th>Producer/Artist Name</th>
                                        <th>Album Photo</th>
                                        <th>Price</th>
                                        <th>Plays</th>
                                        <th>Downloads</th>
                                        <th>Type</th>

                                        <th> Payment Status</th>
                                        <th> Status</th>

                                </thead>
                                 <tbody>

                                </tbody>
                                <tfoot>
                                        <th>Producer/Artist Name</th>
                                        <th>Album Photo</th>
                                        <th>Price</th>
                                        <th>Plays</th>
                                        <th>Downloads</th>
                                        <th>Type</th>
                                        <th> Payment Status</th>
                                        <th> Status</th>
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
<div class="modal fade featuremodal" id="featuremodal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Feature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="featureform" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="brandname">Feature</label>
                        <input type="text" class="form-control form-control-rounded" id="feature"
                            placeholder="Enter Feature" name="feature">
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

<div class="modal fade" id="viewmodal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header">
                <h2 class="modal-title">External Link Content</h2>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <iframe id="link_view" src=""
                style="width:100%; height:350px;" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse-warning" data-dismiss="modal" onclick="closeAudio()"><i class="fa fa-times"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    
        var table = $('#music_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('adminMusic.index')}}",
        columns:[

        {data: 'user.name', name: 'user.name'},
        {data:'cover_art',name:'cover_art',
                      render: function(data, type, full, meta){
                      return "<img src={{ URL::to('') }}/uploadedCoverArts/"+data+ " width='70' class='img-thumbnail' />" ; },orderable: false},   
                      
        {data: 'price', name: 'price'},
        {data: 'views', name: 'views'},
        {data: 'downloads', name: 'downloads'},
        {data: 'type', name: 'type'},
        {data: 'is_paid', name: 'is_paid', orderable: true, searchable: false},
        {data: 'status', name: 'status', orderable: true, searchable: false},
        ],


        });





   function New(music_id) {
       var status = '0';
    $.ajax({
           url:'/music/change/status',
           method:'put',
           data:{
            music_id:music_id,
            status:status,
            _token: "{{ csrf_token() }}"
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
             $('#music_table').DataTable().ajax.reload();
           },
           error:function(data){
             $('#music_table').DataTable().ajax.reload();
           }

       });
    }
    function closeAudio() {
        $('#link_view').attr('src', '');

        
    }

   function Published(music_id) {
       var status = '1';
    $.ajax({
           url:'/music/change/status',
           method:'put',
           data:{
            music_id:music_id,
            status:status,
            _token: "{{ csrf_token() }}"
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
             $('#music_table').DataTable().ajax.reload();
           },
           error:function(data){
             $('#music_table').DataTable().ajax.reload();
           }

       });
    }

    $(function () {

        $(document).on('click', '.view', function(){

                  var id = $(this).attr('id');
                  $('#form_result').html('');
                  $.ajax({
                   url:"/music-show/"+id,
                   dataType:"json",
                   success:function(html){
                    console.log(html.data.music);

                    $('#link_view').attr('src', '/uploadedFiles/'+ html.data.music);
                    $('.modal-title').text("Audio Preview");
                    $('#viewmodal').modal({backdrop: 'static', keyboard: false}) 
                    $('#viewmodal').modal('show');
                   }
                  })
                 });
    });







</script>


@endsection
