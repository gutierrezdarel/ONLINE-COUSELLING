

@extends('layouts.app')

@section('content')


<style>
    .btn{
        background-color: #6690b3;
    }
</style>

<div class="col-lg-9 col-md-9">
    <div class="card shadow-none">
        <div class="card-body shadow-0">
        <div class="card-tool float-right text-muted">
        {{$post->getCategory->category}}
        </div>
        <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{ asset('storage/images/avatar/'.$post->getStudent->avatar)}}" alt="User Image">
        <span class="username">
            <a href="#">{{$post->getStudent->name}}</a>
            
        </span>
        <span class="description">Posted - {{ Carbon\Carbon::parse($post->created_at)->diffForHumans()}} -  @if($post->private != null) &nbsp;<i class="fas fa-lock text-danger" title="Private post"></i>@endif</span>
        </div>
        <!-- /.user-block -->
        <h5 class="mt-5 text-success font-weight-bold">{{$post->title}}</h5>
        <p>
            {{$post->post}}
        </p>
        <form class="form-horizontal" action="{{route('store.comment.student.postview')}}" method="POST" id="addCommentGuidance">
            <div class="input-group input-group-sm mb-0">
                
                @csrf
                @method('POST')
                <input type="hidden" value="{{$post->id}}" name="post_id">
                <input class="form-control form-control-sm" placeholder="Response" name="comment" id="comment">
                <div class="input-group-append">
                    <button type="submit" class="btn text-light">Send</button>
                </div>
            </div>
            <span class="text-danger error-text comment_error"></span>
        </form>
        </div>
        {{-- <div class="alert alert-success alert-block ml-4 mr-4" id="success-comment-alert">
            <button type="button" class="close text-dark" data-dismiss="alert">x</button>
            <i class="fas fa-check-circle"></i> &nbsp; Comment has been posted!
        </div> --}}
        <!-- Comment Section-->
        <div class="commen-section mt-3" id="comment-section">
            <div class="comment-count text-right mr-4 mb-2 text-muted">
                <i class="far fa-comments"></i> Comments ({{$post->getComments->count()}})</a>
            </div>
            <div class="timeline timeline-inverse">
                @if($comments->count())
                    @foreach ($comments as $comment)
                    <div>
                        <i class="fas fa-comments bg-info"></i>
                        <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> {{ Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>

                        <h3 class="timeline-header"><a href="#">@if($comment->getUsers) {{$comment->getUsers->name}} @endif</a> commented on this post</h3>

                        <div class="timeline-body">
                            {{$comment->comment}}
                        </div>
                        {{--  <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                        </div> --}}
                        </div>
                    </div>
                    @endforeach
                <div>
                    <i class="far fa-clock bg-gray"></i>
                </div>
                @else
                     <div>
                        <i class="fas fa-info-circle bg-danger"></i>
                        <div class="timeline-item">
                      
                        <div class="timeline-body">
                          No comments on this post!
                        </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- End of comment section -->
    </div>
</div>
@endsection
@section('custom_js')
<script>
    

$(function(){
    $("#addCommentGuidance").on('submit', function(e){
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
                        $('#comment').addClass('is-invalid');
                    });
                }else{
                    $('#comment').val('');
                    $('#comment-modal').modal('hide');
                
                    $('#comment-section').html(data.html);
                    console.log(data);
                   // var url ="{{ route('home') }}";
                    //$(location).attr('href', url);
                }
            }
        }).fail(function(data) {
           
          /*   $('#comment').val('');
            $('#comment-modal').modal('hide');
            $('#comment-success').modal('show'); */
            //alert(data.statusText + ": " + data.responseText);
        });
    });
});
</script>
@endsection
