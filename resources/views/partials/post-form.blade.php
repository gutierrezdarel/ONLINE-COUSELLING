
<link href="{{ asset ('vendor/dist/custom/main-page-custom.css')}}" rel="stylesheet" />

 
 @can('is-student-only')
<div class="tab-content mb-5" id="nav-tabContent">
    <!------------Person/social tabpane-------------->
    <div class="tab-pane fade show active" id="personal-social" role="tabpanel" aria-labelledby="personal-social-list">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title m-0">Personal/Social</h5>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                
              </div>
            </div>
            <div class="card-body">
              <h6 class="card-title">Post anything about your PERSONAL or SOCIAL concern</h6>
                <form action="{{route('post.store',1)}}" class="mt-5" method="POST" id="addPostPersonal">
                  @csrf
                  @method('POST')
                  <div class="privacy text-muted">
                    <label for="">Choose Privacy</label>
                    <div class="form-group">
                      <select name="type" id="type-personal" class="form-control type-personal">
                        <option value="" selected disabled>Select Type</option>
                        <option value="0">View by all Guidance</option>
                        <option value="1">View by specific Guidance</option>
                      </select>
                      <span class="text-danger error-text type_error"></span>
                    </div>
                    <div class="form-group" id="guidance-personal-div">
                      <select name="guidance" id="guidance-personal" class="form-control guidance-personal select2">
                        <option value="" selected disabled>Select Specific Guidance</option>
                        @foreach ($guidances as $guidance)
                          <option value="{{$guidance->id}}">{{$guidance->name}}</option>
                        @endforeach
                      </select>
                      <span class="text-danger error-text guidance_error"></span>
                    </div>
                  </div>
                  <div class="post mt-3">
                    <label for="">Create Post</label>
                    <div class="form-group">
                      <input class="form-control" type="text" name="title" placeholder="Title">
                      <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                      <textarea id="inputDescription" class="form-control" rows="4" name="post"></textarea>
                      <span class="text-danger error-text post_error"></span>
                    </div>
                    <div class="text-right">
                      <button type="submit" class="btn text-light btn-flat rounded">Post</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
     <!---------------////-------------------->

    <!------------Academic tabpane-------------->
    <div class="tab-pane fade" id="academic" role="tabpanel" aria-labelledby="academic-list">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title m-0">Academic</h5>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                
              </div>
            </div>
            <div class="card-body">
                <h6 class="card-title">Post anything about your ACADEMIC concern</h6>
                <form action="{{route('post.store',2)}}" class="mt-5" method="POST" id="addPostAcademic">
                  @csrf
                  @method('POST')
                  <div class="privacy text-muted">
                    <label for="">Choose Privacy</label>
                    <div class="form-group">
                      <select name="type" id="type-academic" class="form-control type-academic">
                        <option value="" selected disabled>Select Type</option>
                        <option value="0">View by all Guidance</option>
                        <option value="1">View by specific Guidance</option>
                      </select>
                      <span class="text-danger error-text type_error"></span>
                    </div>
                    <div class="form-group" id="guidance-academic-div">
                      <select name="guidance" id="guidance-academic" class="form-control guidance-academic select2">
                        <option value="" selected disabled>Select Specific Guidance</option>
                        @foreach ($guidances as $guidance)
                          <option value="{{$guidance->id}}">{{$guidance->name}}</option>
                        @endforeach
                      </select>
                      <span class="text-danger error-text guidance_error"></span>
                    </div>
                  </div>
                  <div class="post mt-3">
                    <label for="">Create Post</label>
                    <div class="form-group">
                      <input class="form-control" type="text" name="title" placeholder="Title">
                      <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                      <textarea id="inputDescription" class="form-control" rows="4" name="post"></textarea>
                      <span class="text-danger error-text post_error"></span>
                    </div>
                    <div class="text-right">
                      <button type="submit" class="btn btn-flat text-light rounded">Post</button>
                    </div>
                  </div>
                </form>
                
          
            </div>
        </div>
    </div>
     <!---------------////-------------------->

    <!------------Career tabpane-------------->
    <div class="tab-pane fade" id="career" role="tabpanel" aria-labelledby="career-list">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title m-0">Career</h5>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                
              </div>
            </div>
            <div class="card-body">
                <h6 class="card-title">Post anything about your CAREER concern</h6>
                <form action="{{route('post.store',3)}}" class="mt-5" method="POST" id="addPostCareer">
                  @csrf
                  @method('POST')
                  <div class="privacy text-muted">
                    <label for="">Choose Privacy</label>
                    <div class="form-group">
                      <select name="type" id="type-career" class="form-control type-career">
                        <option value="" selected disabled>Select Type</option>
                        <option value="0">View by all Guidance</option>
                        <option value="1">View by specific Guidance</option>
                      </select>
                      <span class="text-danger error-text type_error"></span>
                    </div>
                    <div class="form-group" id="guidance-career-div">
                      <select name="guidance" id="guidance-career" class="form-control guidance-career select2">
                        <option value="" selected disabled>Select Specific Guidance</option>
                        @foreach ($guidances as $guidance)
                          <option value="{{$guidance->id}}">{{$guidance->name}}</option>
                        @endforeach
                      </select>
                      <span class="text-danger error-text guidance_error"></span>
                    </div>
                  </div>
                  <div class="post mt-3">
                    <label for="">Create Post</label>
                    <div class="form-group">
                      <input class="form-control" type="text" name="title" placeholder="Title">
                      <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                      <textarea id="inputDescription" class="form-control" rows="4" name="post"></textarea>
                      <span class="text-danger error-text post_error"></span>
                    </div>
                    <div class="text-right">
                      <button type="submit" class="btn btn-flat text-light rounded">Post</button>
                    </div>
                  </div>
                </form>
                
            </div>
        </div>
    </div>
    <!---------------////-------------------->
</div>
<div id="my-post">
  @foreach ($posts as $post)
    <div class="post clearfix mb-4 p-3 shadow-sm border">
      <div class="user-block">
        <a href="#" class="text-dark text-bold">{{$post->getCategory->category}}</a>
        <a href="#" class="float-right btn-tool text-danger" data-toggle="modal" data-target="#delete-{{$post->id}}" title="Delete this post">
          <span class="delete-icon"><i class="far fa-trash-alt"></i></span>
        </a>
        <br>
        <small>You posted {{ Carbon\Carbon::parse($post->created_at)->diffForHumans()}} @if($post->private != null) &nbsp;<i class="fas fa-lock text-danger" title="Visible only to {{$post->privateTo->name}}"></i>@endif </span> </small>
      </div>
      <!-- /.user-block -->
      <h5 class="mb-4 text-uppercase" id="title">{{$post->title}}</h5>
      <p id="post-body">
       {{$post->post}}
      </p>
      <div class="commen-section mt-3" id="comment-section">
       
      </div>
      <small> <i class="far fa-comments"></i> Comments (<span class="comment-count">{{$post->getComments->count()}}</span>)</small>
      <a href="{{route('view.post.student',$post->id)}}" class="btn text-light btn-sm float-right" > Comment</a>
    </div>
    <!-- Delete Modal-->
    <div class="modal fade" id="delete-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="deletePost" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <form action="{{route('post.destroy',$post->id)}}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Delete Post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this post?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal" style="background-color: white">Cancel</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endcan

@can('is-guidance-only')
<div id="post-div">
   @foreach ($posts as $post)
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
        <span class="description">Posted - {{ Carbon\Carbon::parse($post->created_at)->diffForHumans()}} @if($post->private != null) &nbsp;<i class="fas fa-lock text-danger" title="Private post"></i>@endif </span>
      </div>
        <!-- /.user-block -->
      <h5 class="mt-5 text-dark font-weight-bold" id="title">{{$post->title}}</h5>
        <p id="post-body">
          {{$post->post}}
        </p>
        
        <div class="comment-section mt-1" id="comment-section">
           
        </div>
        <small>  <i class="far fa-comments"></i> Comments (<span class="comment-count">{{$post->getComments->count()}}</span>)</small>
        <a href="{{route('view.post',$post->id)}}" class="btn btn-sm float-right view-post text-light" data-id="{{$post->id}}"> Comment</a> 
      </div>
    </div>
    <hr>
   @endforeach
   {!!$posts->withQueryString()->links()!!}
</div>
 <!---------------////-------------------->
@endcan

<!-- Modal -->
<div class="modal fade" id="comment-modal" role="dialog" aria-labelledby="comment-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form class="form-horizontal" action="{{route('store.comment')}}" method="POST" id="addCommentGuidance">
      @csrf
      @method('POST')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Comment on this post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="comment">Comment</label>
            <input type="hidden" name="post_id" id="post-id">
            <textarea class="form-control"name="comment" id="comment" cols="60" rows="5"></textarea>
            <span class="text-danger error-text comment_error"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="comment-success" role="dialog" aria-labelledby="comment-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Success</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Your comment has been posted!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--------Comment error modal, comment already taken-------->
<div class="modal fade" id="takenCommentError" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body table-responsive p-0 text-sm">
          <div class="mb-4 p-3 bg-danger">
              <h5>Failed!</h5>
          </div>
          <div class="pl-4 pr-4 pb-4">
              <p>Failed to comment. Post has already been taken by other Guidance!</p>
              <a href="{{route('home')}}" class="btn btn-secondary btn-flat float-right mb-2">Return</a>
          </div>
      </div>
      
    </div>
  </div>
</div>
<!----------------->
