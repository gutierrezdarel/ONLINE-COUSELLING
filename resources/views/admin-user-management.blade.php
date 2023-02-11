@extends('layouts.app')

@section('content')

@section('content_header')
<h1 class="m-0"> Dashboard <small></small></h1>
@stop
    
    <!-- /.col-md-6 -->
    <div class="col-lg-9">
        @can('is-admin')
            @include('partials.users-datatable')
        @endcan
       
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Manage Sections</h5>
        </div>
        <div class="card-body">
            <a href="" class="btn btn-success btn-sm mb-2 btn-flat" data-toggle="modal" data-target="#add-section-modal"><i class="far fa-plus-square"></i> Add Section</a>
            <table id="example2" class="table table-bordered table-sm table-hover">
                <thead>
                  <tr>
                    <th scope="col">Section</th>
                    <th scope="col">Students</th>
                    <th scope="col">Posts</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sections as $section)
                    @php
                      $counter=0;
                    @endphp
                    <tr>
                      <td>{{$section->section}} @if($section->getStudents) @endif</td>
                      <td>{{$section->getStudents->count()}}</td>
                      <td>
                         @foreach ($section->getStudents as $students)
                             @php
                                $counter = $counter + $students->getPosts->count();
                             @endphp
                         @endforeach
                        @php
                          echo $counter;
                        @endphp
                      </td>
                      <td>
                          <a href="" class="btn btn-info btn-sm btn-flat" data-id="{{$section->id}}"><i class="far fa-edit"></i></a>
                          <a href="" class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-{{$section->id}}"><i class="far fa-trash-alt"></i></a>
                      </td>
                    </tr>
                    <!-- Disable Modal-->
                    <div class="modal fade" id="delete-{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="deletePost" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <form action="{{route('section.destroy',$section->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Delete Section</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete <span class="text-success">{{$section->section}}</span> section?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary btn-sm btn-flat" data-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-danger btn-sm btn-flat">Delete</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </tbody>
            </table>
        </div>
      </div>
      @if($sections->count() > 0)
      <!--Edit Section Modal-->
      <div class="modal fade" id="edit-section-modal" tabindex="-1" role="dialog" aria-labelledby="editSection" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form action="{{route('section.update',$section->id)}}" method="post" id="editSection">
              @csrf
              @method('PUT')
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="section">Section <span class="text-danger">*</span></label>
                  <input type="hidden" class="form-control" id="section_id" name="section_id">
                  <input type="text" class="form-control" id="section" name="section">
                  <span class="text-danger error-text section_error"></span>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-flat">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      @endif
      <!--Add Section Modal-->
      <div class="modal fade" id="add-section-modal" tabindex="-1" role="dialog" aria-labelledby="editSection" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form action="{{route('section.store')}}" method="post" id="addSection">
              @csrf
              @method('POST')
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="section">Section <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="section" name="section">
                  <span class="text-danger error-text section_error"></span>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-flat">Submit</button>
              </div>
            </form>
          </div>
        </div>
    </div>

@endsection

@section('custom_js')
<script>




$('#section-div').hide();

$("#example1").find('a[data-id]').on('click', function (e) {
    e.preventDefault();
    $('#editUserModal').modal('show');
        
    let id = $(this).data('id');
    var getUrl = "{{route('user.edit', ':id')}}";
    getUrl = getUrl.replace(':id', id);

    $.ajax({
        type: "GET",
        url: getUrl,
        dataType: "json",
        success: function(data) {
            $('#edit-name').val(data.user.name);
            $('#edit-email').val(data.user.email);
            $('#user-id').val(data.user.id);
            $('#section-role-edit').html(data.html);  
        }
    });
});

$(function(){
  $("#editUserForm").on('submit', function(e){
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
                      $('input.'+prefix).addClass('is-invalid');
                      $("input[name="+prefix+"]").addClass('is-invalid');
                      $("select[name="+prefix+"]").addClass('is-invalid');
                  });
                  
              }else{
                  var url ="{{ route('user.index') }}";
                  $(location).attr('href', url);
              }
          }
      }).fail(function(data) {
          alert(data.statusText + ": " + data.responseText);
      });
  });
});


$("#example2").find('a[data-id]').on('click', function (e) {
    e.preventDefault();
    $('#edit-section-modal').modal('show');
        
    let sectionId = $(this).data('id');
    var getUrl = "{{route('section.info', ':sectionId')}}";
    getUrl = getUrl.replace(':sectionId', sectionId);

    $.ajax({
        type: "GET",
        url: getUrl,
        dataType: "json",
        success: function(data) {
            $('#section_id').val(data.id);
            $("#section").val(data.section);
        }
    });
});

$(function(){
  $("#editSection").on('submit', function(e){
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
                  var url ="{{ route('user.index') }}";
                  $(location).attr('href', url);
              }
          }
        }).fail(function(data) {
            alert(data.statusText + ": " + data.responseText);
        });
  });

  $("#addSection").on('submit', function(e){
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
                  var url ="{{ route('user.index') }}";
                  $(location).attr('href', url);
              }
          }
        }).fail(function(data) {
            alert(data.statusText + ": " + data.responseText);
        });
  });

});

$('#role').on('change',function(){
    if($('#role').val() == 4){
        $('#section-div').show();
    }else{
        $('#section-div').hide();
        $("#student_section").val('').trigger('change');
    }
});

$(function () {
  $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    "buttons": ["excel"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
});
$(function(){
    $("#addUserForm").on('submit', function(e){
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
                        $('input.'+prefix).addClass('is-invalid');
                        $("input[name="+prefix+"]").addClass('is-invalid');
                        $("select[name="+prefix+"]").addClass('is-invalid');
                    });
                    
                }else{
                    $('#inviteSuccessModal').modal({
                        backdrop: 'static',
                        color: 'black', 
                        keyboard: false
                    });
                    $('#addUserModal').modal('toggle');
                }
            }
        }).fail(function(data) {
            alert(data.statusText + ": " + data.responseText);
        });
    });
});

$('#closeSuccessModal').click(function() {
    location.reload();
})


</script>
@stop
