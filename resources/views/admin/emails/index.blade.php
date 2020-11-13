@extends('admin.layout.main')
@section('content')



<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Mail Compose</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Music</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Mail</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mail Compose</li>
         </ol>
	   </div>
    
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
           <div class="card-body">

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
        
        <div class="col-lg-12 col-md-12">
            
            <div class="card mt-3">
                <div class="card-body">
                <form method="POST" action="{{route('bulkEmailsSend')}}">
                  @csrf
                        <div class="form-group">
                          <select name="clients" id="" class="form-control">
                            <option value="">Select Recipients</option>
                            <option value="producers">Producers</option>
                            <option value="artist">Artists</option>
                            <option value="normal-users">Normal Users</option>
                            <option value="both">Both Producers and Artists</option>
                          </select>
                        </div>
                       
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject" name="subject">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="summernoteEditor" placeholder="Message body" name="message" rows="30"></textarea>
                        </div>
                        <div class="form-group">
                          
                        <a  href="{{route('dashboard')}}"  class="btn btn-danger waves-effect waves-light m-1"><i class="fa fa-trash-o"></i> Cancel</a>
                            <button type="submit" class="btn btn-dark waves-effect waves-light m-1"> <span>Send</span> <i class="fa fa-send ml-10"></i> </button>
                        </div>
                    </form>
                </div> <!-- card body -->
             </div> <!-- card -->
           </div> <!-- end Col-9 -->
         </div><!-- End row -->
      </div>
    </div>
  </div>
<script>
     $(document).ready(function(){
        $(".alert").delay(5000).slideUp(300);
      });

      
</script>
@endsection