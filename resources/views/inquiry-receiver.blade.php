@extends('layouts.app')

@section('content')
<div class="col-lg-9">

   <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Manage Recipients</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <a href="" class="btn btn-success mb-3 btn-flat btn-sm" data-toggle="modal" data-target="#addModal"><i class="fas fa-user-plus"></i> Add Recipient</a>
            @if($receivers->count())
            @foreach ($receivers as $receiver)
            <div class="form-group row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="email" placeholder="Input Email" value="{{$receiver->email}}" readonly>
                </div>
                <a  class="btn btn-info mr-2 p-2 edit btn-flat btn-sm" data-id="{{$receiver->id}}"><i class="far fa-edit"></i>Edit</a>
                <a  class="btn btn-danger mr-2 p-2 btn-flat btn-sm" data-toggle="modal" data-target="#delete-{{$receiver->id}}"><i class="far fa-trash-alt"></i>Delete</a>
            </div>
            <!--Delete Modal-->
            <div class="modal fade" id="delete-{{$receiver->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{route('destroy.receivers',$receiver->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Recipient</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete <span class="text-danger font-weight-bold">{{$receiver->email}}</span> from list of recipients?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-flat">Delete</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            @endforeach
            @else
            <p class="text-danger">No recipient found! This might cause issue on your CONTACT website main page. Please add valid recipient immediately.</p>
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
           
        <!-- /.card-footer -->
        </div>
  
    </div>

</div>
<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form action="{{route('store.receivers')}}" id="addRecipient" method="post">
            @csrf
            @method('post')
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Recipient</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                    <span class="text-danger error-text email_error"></span>
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-flat">Save changes</button>
            </div>
        </form>
    </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form action="{{route('update.receivers')}}" id="editRecipient" method="post">
            @csrf
            @method('post')
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Recipient</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="hidden" name="email_id" id="email_id">
                    <input type="email" class="form-control" name="email" id="email_edit">
                    <span class="text-danger error-text email_error"></span>
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-flat">Save changes</button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
$('.edit').on('click',function(){
    $('#email_id').val($(this).data('id'));
    $('#editModal').modal('show');

    let emailId = $(this).data('id');
    var getUrl = "{{route('get.receiver.info', ':emailId')}}";
    getUrl = getUrl.replace(':emailId', emailId);

    $.ajax({
        type: "GET",
        url: getUrl,
        dataType: "json",
        success: function(data) {
            $("#email_edit").val(data.email);
        }
    });

});

$(function(){
    $("#editRecipient").on('submit', function(e){
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
                        $('#email_edit').addClass('is-invalid');
                    });
                }else{
                    //$('#comment-count').text('tite');
                    var url ="{{ route('edit.receivers') }}";
                    $(location).attr('href', url);
                }
            }
        }).fail(function(data) {
           
           // $('#comment-success').modal('show');
           // alert(data.statusText + ": " + data.responseText);
        });
    });
});

$(function(){
    $("#addRecipient").on('submit', function(e){
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
                        $('#email').addClass('is-invalid');
                    });
                }else{
                  
                    //$('#comment-count').text('tite');
                    var url ="{{ route('edit.receivers') }}";
                    $(location).attr('href', url);
                }
            }
        }).fail(function(data) {
           
           // $('#comment-success').modal('show');
           // alert(data.statusText + ": " + data.responseText);
        });
    });
});



</script>
@endsection