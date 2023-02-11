<div class="form-group">
    <input type="hidden" value="{{$type}}-{{$result->id}}" name="id_type">
    <label for="about_title">Title</label>
    <input type="text" class="form-control" name="about_title" id="about_title" value="{{$result->title}}">
    <span class="text-danger error-text about_title_error"></span>
</div>
<div class="form-group">
    <label for="about_desc">Description</label>
    <textarea class="form-control" name="about_desc" id="about_desc" cols="30" rows="10">
        {{$result->desc}}
    </textarea>
    <span class="text-danger error-text about_desc_error"></span>
</div>
