
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close text-dark" data-dismiss="alert">x</button>
    <i class="fas fa-check-circle"></i> &nbsp;{!!$message!!}
</div>
@elseif($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close text-dark" data-dismiss="alert">x</button>
    <i class="fas fa-times"></i> &nbsp;{{$message}}
</div>
@elseif($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close text-dark" data-dismiss="alert">x</button>
    <i class="fas fa-info-circle"></i> &nbsp;{{$message}}
</div>
@elseif($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close text-dark" data-dismiss="alert">x</button>
    <i class="fas fa-exclamation-triangle"></i> &nbsp;{{$message}}
</div>
@endif