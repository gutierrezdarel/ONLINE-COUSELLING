@if(str_contains(url()->current(), '/user/manage'))
    
  <div class="card">
    <div class="card-header">
        <h5>Manage Sections</h5>
    </div>
    <div class="card-body">
        <a href="" class="btn btn-success btn-sm mb-2 btn-flat" data-toggle="modal" data-target="#add-section-modal"><i class="far fa-plus-square"></i> Add Section</a>
        <table id="example2" class="table table-bordered table-sm">
            <thead>
              <tr>
                <th scope="col">Section</th>
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
                  <td>{{$section->section}} @if($section->getStudents) (<span class="text-success font-weight-bold">{{$section->getStudents->count()}}</span>) @endif</td>
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
                          <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-danger btn-flat">Delete</button>
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
  <!--Edit Modal-->
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endif
  <!--Add Modal-->
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endif

