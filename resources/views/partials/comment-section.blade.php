<div class="comment-count text-right mr-4 mb-2 text-muted">
    <i class="far fa-comments"></i> Comments ({{$post->getComments->count()}})</a>
</div>
<div class="timeline timeline-inverse">
    @if($post->getComments->count())
        @foreach ($post->getComments as $comment)
        <div>
            <i class="fas fa-comments bg-info"></i>
            <div class="timeline-item">
                <span class="time"><i class="far fa-clock"></i> {{ Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>

                <h3 class="timeline-header"><a href="#">@if($comment->getUsers) {{$comment->getUsers->name}} @endif</a> commented on this post</h3>

                <div class="timeline-body">
                    {{$comment->comment}}
                </div>
                <div class="timeline-footer">
                   {{-- <a href="" class="btn btn-danger">delete</a> --}}
                </div>
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