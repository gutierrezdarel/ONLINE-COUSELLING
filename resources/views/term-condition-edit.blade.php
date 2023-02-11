@extends('layouts.app')

@section('content')
<div class="col-lg-9">
   
    <form action="{{route('update.terms',$term->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Edit Terms and Conditions</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group">
                <textarea id="compose-textarea" class="form-control" style="height: 300px" name="desc">{{$term->desc}}</textarea>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="float-right">
            <a href="{{route('edit.terms',1)}}" type="reset" class="btn btn-default btn-flat"><i class="fas fa-times"></i> Discard</a>
            <button type="submit" class="btn btn-primary btn-flat"><i class="far fa-save"></i> Save</button>
            </div>
            
        </div>
        <!-- /.card-footer -->
    </div>
    </form>

</div>
@endsection

@section('custom_js')
<script>
$(function () {
    //Add text editor
  $('#compose-textarea').summernote()
})
</script>
@endsection