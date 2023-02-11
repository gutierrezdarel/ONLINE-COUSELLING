<div class="timeline timeline-inverse">
    @if($comments->count())
        @foreach ($comments as $comment)
        <div>
            <i class="fas fa-comments bg-info"></i>
            <div class="timeline-item">
            <span class="time"><i class="far fa-clock"></i> {{ Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>

            <h3 class="timeline-header"><a href="#">@if($comment->getUsers) {{$comment->getUsers->name}} @endif</a> commented on this post</h3>

            <div class="timeline-body">
                {{$comment->comment}}
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