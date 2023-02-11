

@extends('layouts.app')

@section('content')
@section('content_header')
<h1 class="m-0"> Manage Profile <small></small></h1>
@stop
<link href="{{ asset ('vendor/dist/custom/main-page-custom.css')}}" rel="stylesheet" />
 <!-- Main content -->
 
<div class="col-lg-6 col-md-9 col-sm-12">
    <div class="container">
        <div class="card">
            <div class="card-header p-2">
                <h5>Edit your profile</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 px-5 m-2">
                        <div class="form-group">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{asset('storage/images/avatar/'.$user->avatar)}}"
                                    alt="User profile picture">
                            </div>
                        </div>
                        <form action="{{route('edit.avatar',$user->id)}}" method="post" enctype="multipart/form-data" id="uploadAvatar">
                        @csrf
                        @method('put')
                        <div class="form-group">
                             <label for="exampleInputFile">Change Default Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="form-control-file" id="avatar" name="avatar">
                                    
                                </div>
                                <button type="submit" class="btn text-light">Upload</button>
                            </div>
                            <span class="text-danger error-text avatar_error"></span>
                        </div>
                        </form>
                    </div>
                </div>
                
                    @can('is-admin')
                     <div class="col-sm">
                        <form action="{{route('update.profile')}}" method="post" id="submitProfile">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                            <span class="text-danger error-text email_error"></span>
                        </div>
                        <div class="form-group float-right mt-3">
                            <button type="submit"class="btn text-light">Save Changes</button>
                        </div>
                    </form> 
                    </div>
                    @endcan
                </div>
            </div>
         
     </div>
</div>

  <!-- /.content -->

<!-------Upload Success added modal--------->
<div class="modal fade" id="uploadSuccessModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body table-responsive p-0 text-sm">
            <div class="mb-4 p-3 bg-success">
                <h5>Uploaded!</h5>
            </div>
            <div class="pl-4 pr-4 pb-4">
                <h5><i class="far fa-check-circle"></i> Profile has been uploaded!</h5>
                <button type="button" class="btn btn-secondary btn-flat float-right mb-2" data-dismiss="modal" id="closeSuccessModal">Return</button>
            </div>
        </div>
        
      </div>
    </div>
</div>
  <!----------------->
@endsection

@section('custom_js')
<script>
 $(function(){
    $("#uploadAvatar").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
           //dataType:'file',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data){
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else{
                    console.log(data);
                    $('#uploadSuccessModal').modal('show');
                    //var url ="{{ route('edit.profile') }}";
                    //$(location).attr('href', url);
                }
            }
        });
    });
});

$('#uploadSuccessModal').click(function() {
    location.reload();
})

$(function(){
    $("#submitProfile").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data){
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                        $('input[name='+prefix+']').addClass('is-invalid');
                    });
                }else{
                    var url ="{{ route('edit.profile') }}";
                    $(location).attr('href', url);
                }
            }
        }).fail(function(data) {
         
           // $('#comment-success').modal('show');
            alert(data.statusText + ": " + data.responseText);
        });
    });
});
  
</script>
@endsection