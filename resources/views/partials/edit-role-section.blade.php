
<div class="form-group">
    <label for="exampleInputPassword1">Role</label>
    <select class="form-control" name="role" id="edit-role">
      <option value="" selected disabled>Select User Role</option>
      @foreach ($roles as $role)
      <option value="{{$role->id}}"@if($user->getUserPrimaryRole()->id == $role->id) selected @endif>{{$role->role}}</option>
      @endforeach
    </select>
    <span class="text-danger error-text role_error"></span>
</div>

<div class="form-group" id="edit-section-div">
    <label for="exampleInputPassword1">Student Section</label>
    <select class="form-control select2" name="student_section" id="edit_student_section">
      <option value="" selected disabled>Select Student Section</option>
      @foreach ($sections as $section)
      <option value="{{$section->id}}" @if($user->getSection) @if($user->getSection->id == $section->id) selected @endif @endif>{{$section->section}}</option>
      @endforeach
    </select>
    <span class="text-danger error-text student_section_error"></span>
</div>

<script>
$(document).ready(function(){
    if($('#edit-role').val() == 4){
        $('#edit-section-div').show();
    }else{
        $('#edit-section-div').hide();
        $("#edit_student_section").val('').trigger('change');
    }
});

$('#edit-role').on('change',function(){
    if($('#edit-role').val() == 4){
        $('#edit-section-div').show();
    }else{
        $('#edit-section-div').hide();
        $("#edit_student_section").val('').trigger('change');
    }
});

</script>