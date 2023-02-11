@extends('layouts.app')

@section('content')

    @section('content_header')
    <h1 class="m-0"> Dashboard <small></small></h1>
    @stop
    <!-- /.col-md-6 -->
    <div class="col-lg-6">
        @include('partials.post-form')
    </div>
    
    <!-- /.col-md-6 -->
    <div class="col-lg-3 text-center text-lg">
        @include('partials.sidebar-category')
    </div>
    <!-- /.col-md-6 -->
@endsection
@section('custom_js')
<script>
$( document ).ready(function() {
    $('#guidance-personal-div').hide();
    $('#guidance-academic-div').hide();
    $('#guidance-career-div').hide();
});
$('#type-personal').on('change',function(){
    if($('#type-personal').val() == 1){
        $('#guidance-personal-div').show();
    }else{
        $('#guidance-personal-div').hide();
    }
});
$('#type-academic').on('change',function(){
    if($('#type-academic').val() == 1){
        $('#guidance-academic-div').show();
    }else{
        $('#guidance-academic-div').hide();
    }
});
$('#type-career').on('change',function(){
    if($('#type-career').val() == 1){
        $('#guidance-career-div').show();
    }else{
        $('#guidance-career-div').hide();
    }
});
$(function(){
    $("#addPostPersonal").on('submit', function(e){
        e.preventDefault();
        var type = $('#type').val();
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
                    });
                }else{
                   
                    var url ="{{ route('home') }}";
                    $(location).attr('href', url);
                }
            }
        });
    });
});

$(function(){
    $("#addPostAcademic").on('submit', function(e){
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
                    });
                }else{
                    var url ="{{ route('home') }}";
                    $(location).attr('href', url);
                }
            }
        });
    });
});

$(function(){
    $("#addPostCareer").on('submit', function(e){
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
                    });
                }else{
                    var url ="{{ route('home') }}";
                    $(location).attr('href', url);
                }
            }
        });
    });
});

$('.comment-button').on('click',function(e){
    e.preventDefault();
    $('#post-id').val($(this).data("id") );
    $('#comment-modal').modal('show');
})

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
                    });
                }else{
                    $('#comment').val('');
                    $('#comment-modal').modal('hide');
                    $('.comment-section').html(data.html);
                    $('#comment-success').modal('show');
                   
                    //$('#comment-count').text('tite');
                   // var url ="{{ route('home') }}";
                    //$(location).attr('href', url);
                }
            }
        }).fail(function(data) {
            $('#comment').val('');
            $('#comment-modal').modal('hide');
            $('.comment-section').html(data.html);
           // $('#comment-success').modal('show');
            //alert(data.statusText + ": " + data.responseText);
        });
    });
});

$('.view-comments').on('click',function(e){
    e.preventDefault();

    let postId =  $(this).attr("data-id");
    var getUrl = "{{route('get.post.comments', ':postId')}}";
    getUrl = getUrl.replace(':postId',postId);

    $.ajax({
        type: "GET",
        url: getUrl,
        dataType: "json",
        success: function(data) {
            console.log(data);
            $('#comment-section').html(data.html);
        }
    }).fail(function(data) {
        alert(data.statusText + ": " + data.responseText);
    });
    
});
$('#comment-success').on('hidden.bs.modal', function () {
    location.reload();
})
</script>
@stop
