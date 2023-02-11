<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use auth;
use Validator;

class CommentController extends Controller
{
    //

    public function storeComment(Request $request){

        
        $messages = array(
           
        );
        $rules = array(
            'comment'  =>    'required|string',      
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

    
        $comment = new Comment();
        $comment->user_id = auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();

        //make as private once guidance commented
        if(Gate::allows('is-guidance-only')){
            $post = Post::find($request->post_id);
            $post->private = auth::user()->id;
            $post->save();
        }   
        //---------------------//
        
        return response()->json(['success'=>true]);
       
    }

    public function storeCommentPostView(Request $request){
      
        $messages = array(
           
        );
        $rules = array(
            'comment'  =>    'required|string',      
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
    
        $checkIfPrivate = Post::where('id',$request->post_id)->whereNull('private')->count();

        $post = Post::findOrFail($request->post_id);

        if($checkIfPrivate || $post->private == auth::user()->id){
            
            $comment = new Comment();
            $comment->user_id = auth::user()->id;
            $comment->post_id = $request->post_id;
            $comment->comment = $request->comment;
            $comment->save();

            $post->private = auth::user()->id;
            $post->save();
        }else{

            return response()->json(['private'=>1]);
        }
       

        $html = view("partials.comment-section")->with([
           'post'    =>  $post,
        ])->render();

        $data = [
            'html'  =>  $html,
        ];

        return response()->json($data, 200);
    }

    public function storeCommentByStudentPostView(Request $request){
        $messages = array(
           
        );
        $rules = array(
            'comment'  =>    'required|string',      
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
    	
        $post = Post::findOrFail($request->post_id);

        $comment = new Comment();
        $comment->user_id = auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();

      
        $html = view("partials.comment-section-student")->with([
           'post'    =>  $post,
           'comments'   =>  $post->getComments()->orderBy('created_at','desc')->paginate(3),
           'countComments'  =>  $post->getComments()->orderBy('created_at','desc')->count(),
        ])->render();

        $data = [
            'html'  =>  $html,
        ];

        return response()->json($data, 200);
    }


    public function getComments($postId){
     
        //$comments = Comment::where('post_id',$postId)->get();

        $html = view("partials.comment-section-home")->with([
            'comments'    =>  Comment::where('post_id',$postId)->paginate(3),
         ])->render();

        return response()->json([
            'success'   =>  true,
            'html'  =>  $html,
        ]);
    }
}
