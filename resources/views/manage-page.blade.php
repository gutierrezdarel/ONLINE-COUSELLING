@extends('layouts.app')

@section('content')

@section('content_header')
<h1 class="m-0"> Manage Page <small></small></h1>
@stop
    
<div class="container-fluid">
    <div class="card p-3">
        <nav class="w-100">
        <div class="nav nav-tabs card-header" id="product-tab" role="tablist">
            <a class="nav-item nav-link active" id="banner-services-tab" data-toggle="tab" href="#banner-services" role="tab" aria-controls="banner-services" aria-selected="true">Banner - Services</a>
            <a class="nav-item nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false">About</a>
            <a class="nav-item nav-link" id="guidance-team-tab" data-toggle="tab" href="#guidance-team" role="tab" aria-controls="guidance-team" aria-selected="false">Guidance Team</a>
        </div>
        </nav>
        <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="banner-services" role="tabpanel" aria-labelledby="banner-services-tab"> 
                <div class="row">
                    <div class="col-sm border p-3 m-2">
                        <div class="row mb-2">
                            <div class="col-sm">
                                <h5>Banner</h5>
                            </div>
                            <div class="col-sm">
                                <div class="actions float-right">
                                    @if($banner)
                                        <a href="#" class="btn btn-sm btn-danger delete-categ" data-id="banner-{{$banner->id}}"><i class="far fa-trash-alt"></i></a>
                                    @else
                                        <a href="" class="btn btn-sm btn-success"><i class="far fa-plus-square"></i></a>
                                    @endif
                                </div>
                            </div>
                           
                        </div>
                        <div class="alert alert-block" id="alert-banner">
                            <button type="button" class="close text-dark" onclick="$('.alert').hide()">x</button>
                            <i class="fas fa-check-circle"></i> &nbsp;<span id="message"></span>
                        </div>
                        @if($banner)
                        <form action="{{route('manage.banner.update',$banner->id)}}" method="post" id="updateBanner">
                            @csrf
                            @method('PUT')
                            <div class="banner-form" id="banner-form">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="banner_title" id="banner_title" value="{{$banner->title}}" placeholder="Enter Title">
                                    <span class="text-danger error-text banner_title_error"></span>
                                </div>
                                <div class="form-group">
                                <input class="form-control" type="text" name="banner_desc" id="banner_desc" value="{{$banner->body}}"  placeholder="Enter Description">
                                <span class="text-danger error-text banner_desc_error"></span>
                                </div>
                            </div>
                            <div class="form-group float-right">
                               <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                        @else
                            <p>No record found</p>
                        @endif
                    </div>
                    <div class="col-sm border p-3 m-2">
                        <div class="row mb-2">
                            <div class="col-sm">
                                <h5>Service Title</h5>
                            </div>
                            <div class="col-sm">
                                <div class="actions float-right">
                                    @if($serviceTitle)
                                        <a href="#" class="btn btn-sm btn-danger delete-categ" data-id="service-{{$serviceTitle->id}}"><i class="far fa-trash-alt"></i></a>
                                    @else
                                        <a href="" class="btn btn-sm btn-success"><i class="far fa-plus-square"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-block" id="alert-service">
                            <button type="button" class="close text-dark" onclick="$('.alert').hide()">x</button>
                            <i class="fas fa-check-circle"></i> &nbsp;<span id="message-service"></span>
                        </div>
                        @if($serviceTitle)
                        <form action="{{route('manage.service.update',$serviceTitle->id)}}" method="post" id="updateServiceTitle">
                            @csrf
                            @method('PUT')
                            <div class="banner-form" id="banner-form">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="service_title" id="service_title" value="{{$serviceTitle->title}}" placeholder="Enter Title">
                                    <span class="text-danger error-text service_title_error"></span>
                                </div>
                                <div class="form-group">
                                <input class="form-control" type="text" name="service_desc" id="service_desc" value="{{$serviceTitle->description}}"  placeholder="Enter Description">
                                <span class="text-danger error-text service_desc_error"></span>
                                </div>
                            </div>
                            <div class="form-group float-right">
                               <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                        @else
                            <p>No record found</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm border p-3 m-2">
                        <div class="row mb-2">
                            <div class="col-sm">
                                <h5>Category 1</h5>
                            </div>
                            <div class="col-sm">
                                <div class="actions float-right">
                                    @if($personal)
                                        <a href="#" type="button" class="btn btn-sm btn-danger delete-categ" data-id="category-{{$personal->id}}"><i class="far fa-trash-alt"></i></a>
                                    @else
                                        <a href="" class="btn btn-sm btn-success"><i class="far fa-plus-square"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-block" id="alert-personal">
                            <button type="button" class="close text-dark" onclick="$('.alert').hide()">x</button>
                            <i class="fas fa-check-circle"></i> &nbsp;<span id="message-personal"></span>
                        </div>
                        @if($personal)
                        <form action="{{route('manage.personal.update',$personal->id)}}" method="post" id="updateCategoryPersonal">
                            @csrf
                            @method('PUT')
                            <div class="banner-form" id="banner-form">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="category_personal" id="category_personal" value="{{$personal->category}}" placeholder="Enter Category">
                                    <span class="text-danger error-text category_personal_error"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="category_personal_desc" id="category_personal_desc" value="{{$personal->description}}"  placeholder="Enter Description">
                                    <span class="text-danger error-text category_personal_desc_error"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="category_personal_icon" id="category_personal_icon" value="{{$personal->icon}}"  placeholder="Enter icon class">
                                    <small><label for="category_personal_icon"><a href="https://fontawesome.com/" target="_blank">Choose here >></a></label></small>
                                </div>
                            </div>
                            <div class="form-group float-right">
                               <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                        @else
                            <p>No record found</p>
                        @endif
                    </div>
                    <div class="col-sm border p-3 m-2">
                        <div class="row mb-2">
                            <div class="col-sm">
                                <h5>Category 2</h5>
                            </div>
                            <div class="col-sm">
                                <div class="actions float-right">
                                    @if($academic)
                                        <a href="#" type="button" class="btn btn-sm btn-danger delete-categ" data-id="category-{{$academic->id}}"><i class="far fa-trash-alt"></i></a>
                                    @else
                                        <a href="" class="btn btn-sm btn-success"><i class="far fa-plus-square"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-block" id="alert-academic">
                            <button type="button" class="close text-dark" onclick="$('.alert').hide()">x</button>
                            <i class="fas fa-check-circle"></i> &nbsp;<span id="message-academic"></span>
                        </div>
                        @if($academic)
                        <form action="{{route('manage.academic.update',$academic->id)}}" method="post" id="updateCategoryAcademic">
                            @csrf
                            @method('PUT')
                            <div class="banner-form" id="academic-form">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="category_academic" id="category_academic" value="{{$academic->category}}" placeholder="Enter Category">
                                    <span class="text-danger error-text category_academic_error"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="category_academic_desc" id="category_academic_desc" value="{{$academic->description}}"  placeholder="Enter Description">
                                    <span class="text-danger error-text category_academic_desc_error"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="category_academic_icon" id="category_academic_icon" value="{{$academic->icon}}"  placeholder="Enter icon class">
                                    <small><label for="category_academic_icon"><a href="https://fontawesome.com/" target="_blank">Choose here >></a></label></small>
                                </div>
                            </div>
                            <div class="form-group float-right">
                               <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                        @else
                            <p>No record found</p>
                        @endif
                    </div>
                    <div class="col-sm border p-3 m-2">
                        <div class="row mb-2">
                            <div class="col-sm">
                                <h5>Category 3</h5>
                            </div>
                            <div class="col-sm">
                                <div class="actions float-right">
                                    @if($career)
                                        <a href="#" type="button" class="btn btn-sm btn-danger delete-categ" data-id="category-{{$career->id}}"><i class="far fa-trash-alt"></i></a>
                                    @else
                                        <a href="" class="btn btn-sm btn-success"><i class="far fa-plus-square"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-block" id="alert-career">
                            <button type="button" class="close text-dark" onclick="$('.alert').hide()">x</button>
                            <i class="fas fa-check-circle"></i> &nbsp;<span id="message-career"></span>
                        </div>
                        @if($career)
                        <form action="{{route('manage.career.update',$career->id)}}" method="post" id="updateCategoryCareer">
                            @csrf
                            @method('PUT')
                            <div class="banner-form" id="career-form">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="category_career" id="category_career" value="{{$career->category}}" placeholder="Enter Category">
                                    <span class="text-danger error-text category_career_error"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="category_career_desc" id="category_career_desc" value="{{$career->description}}"  placeholder="Enter Description">
                                    <span class="text-danger error-text category_career_desc_error"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="category_career_icon" id="category_career_icon" value="{{$career->icon}}"  placeholder="Enter icon class">
                                    <small><label for="category_career_icon"><a href="https://fontawesome.com/" target="_blank">Choose here >></a></label></small>
                                </div>
                            </div>
                            <div class="form-group float-right">
                               <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                        @else
                            <p>No record found</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab"> 
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="about">Select</label>
                            <select class="form-control select2bs4" name="about" id="about">
                                <option value="" selected disabled>Select Component</option>
                                @if($about)<option value="about-{{$about->id}}"><span id="about-option">{{$about->title}}</span></option>@endif
                                @if($mission)<option value="mission-{{$mission->id}}"><span id="mission-option">{{$mission->title}}</span></option>@endif
                                @if($vision)<option value="vision-{{$vision->id}}"><span id="vision-option">{{$vision->title}}</span></option>@endif
                                @if($common)<option value="common-{{$common->id}}"><span id="common-option">{{$common->title}}</span></option>@endif
                            </select>
                        </div>
                    </div>
                    <div class="col-8 border p-3">
                        <div class="alert alert-block" id="alert-about">
                            <button type="button" class="close text-dark" onclick="$('.alert').hide()">x</button>
                            <i class="fas fa-check-circle"></i> &nbsp;<span id="message-about"></span>
                        </div>
                        <form action="{{route('manage.about.update')}}" method="post" id="updateAbout">
                            @csrf
                            @method('PUT')
                            <div class="about-form" id="about-form">
                                <p>Select Component</p>
                            </div>
                            <div class="form-group float-right submit-about">
                                <button type="submit" class="form-control btn btn-primary" id="submit-about">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="guidance-team" role="tabpanel" aria-labelledby="guidance-team-tab"> 
                3
            </div>
        </div>
    </div>
</div>
@include('modals.banner-modal')
@endsection

@section('custom_js')
<script>
$('.submit-about').hide();
$("select[name=about]").on('change', function()
  {
    let idType= $(this).val();
    var getUrl = "{{route('manage.about.get.info', ':idType')}}";
    getUrl = getUrl.replace(':idType', idType);

    $.ajax({
        type: "GET",
        url: getUrl,
        dataType: "json",
        success: function(data) {
        //console.log(data)
        
        $('#about-form').html(data.html);
        $('.submit-about').show();
    }
    }).done(function(data){
    
    }).fail(function(data) {
        alert(data.statusText + ": " + data.responseText);
    });
});


$(function(){
    $("[data-hide]").on("click", function(){
        $("." + $(this).attr("data-hide")).hide()
        // -or-, see below
        // $(this).closest("." + $(this).attr("data-hide")).hide()
    })
})

$('#alert-banner').hide();
$('#alert-service').hide();
$('#alert-personal').hide();
$('#alert-academic').hide();
$('#alert-career').hide();
$('#alert-about').hide();

$('.delete-categ').on('click', function(){
    $('#delete-category').modal('show');
    var id = $(this).data('id');
    $('#category_id').val(id);
});

$(function(){
    $("#deleteCategory").on('submit', function(e){
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
                        $("input[name="+prefix+"]").addClass('is-invalid');
                    });
                }else{
                    var url ="{{ route('manage.page.index') }}";
                    $(location).attr('href', url);
                }
            }
        }).fail(function(data) {
            alert(data.statusText + ": " + data.responseText);
        });
    });
})
$(function(){
    $("#updateBanner").on('submit', function(e){
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
                        $("input[name="+prefix+"]").addClass('is-invalid');
                    });
                }else{
                    $('#alert-banner').show();
                    $('#alert-banner').removeClass();
                    $('#alert-banner').addClass(data.alert);
                    $('#message').text(data.message);
                    $('#banner_title').removeClass();
                    $('#banner_desc').removeClass();
                    $('#banner_title').addClass(data.alertText);
                    $('#banner_desc').addClass(data.alertText);
                }
            }
        }).fail(function(data) {
            alert(data.statusText + ": " + data.responseText);
        });
    });
});
$(function(){
    $("#updateServiceTitle").on('submit', function(e){
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
                        $("input[name="+prefix+"]").addClass('is-invalid');
                    });
                }else{
                    $('#alert-service').show();
                    $('#alert-service').removeClass();
                    $('#alert-service').addClass(data.alert);
                    $('#message-service').text(data.message);
                    $('#service_title').removeClass();
                    $('#service_desc').removeClass();
                    $('#service_title').addClass(data.alertText);
                    $('#service_desc').addClass(data.alertText);
                }
            }
        }).fail(function(data) {
            alert(data.statusText + ": " + data.responseText);
        });
    });
});
$(function(){
    $("#updateCategoryPersonal").on('submit', function(e){
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
                        $("input[name="+prefix+"]").addClass('is-invalid');
                    });
                }else{
                    $('#alert-personal').show();
                    $('#alert-personal').removeClass();
                    $('#alert-personal').addClass(data.alert);
                    $('#message-personal').text(data.message);
                    $('#category_personal').removeClass();
                    $('#category_personal_desc').removeClass();
                    $('#category_personal').addClass(data.alertText);
                    $('#category_personal_desc').addClass(data.alertText);
                }
            }
        }).fail(function(data) {
            alert(data.statusText + ": " + data.responseText);
        });
    });
});
$(function(){
    $("#updateCategoryAcademic").on('submit', function(e){
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
                        $("input[name="+prefix+"]").addClass('is-invalid');
                    });
                }else{
                    $('#alert-academic').show();
                    $('#alert-academic').removeClass();
                    $('#alert-academic').addClass(data.alert);
                    $('#message-academic').text(data.message);
                    $('#category_academic').removeClass();
                    $('#category_academic_desc').removeClass();
                    $('#category_academic').addClass(data.alertText);
                    $('#category_academic_desc').addClass(data.alertText);
                }
            }
        }).fail(function(data) {
            alert(data.statusText + ": " + data.responseText);
        });
    });
});
$(function(){
    $("#updateCategoryCareer").on('submit', function(e){
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
                        $("input[name="+prefix+"]").addClass('is-invalid');
                    });
                }else{
                    $('#alert-career').show();
                    $('#alert-career').removeClass();
                    $('#alert-career').addClass(data.alert);
                    $('#message-career').text(data.message);
                    $('#category_career').removeClass();
                    $('#category_career_desc').removeClass();
                    $('#category_career').addClass(data.alertText);
                    $('#category_career_desc').addClass(data.alertText);
                }
            }
        }).fail(function(data) {
            alert(data.statusText + ": " + data.responseText);
        });
    });
})

//update about, mission, vision, common
$(function(){
    $("#updateAbout").on('submit', function(e){
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
                        $("input[name="+prefix+"]").addClass('is-invalid');
                        $("#about_desc").addClass('is-invalid');
                    });
                }else{
                    $('#alert-about').show();
                    $('#alert-about').removeClass();
                    $('#alert-about').addClass(data.alert);
                    $('#message-about').text(data.message);
                    $('#about_title').removeClass();
                    $('#about_desc').removeClass();
                    $('#about_title').addClass(data.alertText);
                    $('#about_desc').addClass(data.alertText);
                    //$("input[name="+prefix+"]").addClass('is-valid');
                    //$('#about-option option[name="about"]').text(data.result.title);
                    //console.log(data.result.title);
                   
                }
            }
        }).fail(function(data) {
            alert(data.statusText + ": " + data.responseText);
        });
    });
})
</script>
@stop
