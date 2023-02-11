<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Category;
use Validator;
use auth;

class PostController extends Controller
{
    public function store(Request $request, $category){
     
        $messages = array(
            'title.string'   =>  'Invalid format',
            'post.string'=>'Invalid format',
            'guidance.required_if'  =>  'Please select Guidance.'
        );
        $rules = array(
            'title'  =>    'required|string',
            'post'   =>  'required|string',
            'type'  =>  'required|string',
            'guidance' =>  'required_if:type,1|string',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $post = new Post();
            $post->category_id = $category;
            $post->private = $request->guidance;
            $post->user_id = auth::user()->id;
            $post->title = $request->title;
            $post->post = $request->post;
            $post->save();

            \Session::flash('success', __('Post added!')); 
            return response()->json(['status' => true]);
        }

    }
    public function searchFilter(Request $request){
        $category = $request->category;
        $student = $request->student;

       

        if(Gate::allows('is-guidance-only')){
            return view('home')->with([
                'posts' =>  Post::where("user_id",'like',"{$student}%")
                                ->where('category_id','like',"{$category}%")
                                ->paginate(10),

                'filteredCategory'    =>  $category,
                'filteredStudent'   =>  $student,
               
                'search'    =>  'search',

                'categories'    =>  Category::all(),
                'filterStudents' =>  User::whereDoesntHave('roles', function($q){
                                $q->where('role','Guidance');
                                })->WhereHas('roles', function($q){
                                    $q->where('role','Student');
                                })->get(),
            ]);
        }
    }

    public function viewPost($id){
        
        $checkIfPrivate = Post::where('id',$id)->whereNull('private')->count();
        $post = Post::findOrFail($id);

        if($checkIfPrivate || $post->private == auth::user()->id){

            return view('view-post')->with([
                'post'  =>  $post,
            ]);

        }else{

            return abort(404);
        }
           
    }

    public function viewPostByStudent($id){
        
        
        $post = auth::user()->getPosts()->where('id',$id)->first();
        if($post){
            $comments = $post->getComments()->orderBy('created_at','desc')->paginate(3);
            return view('view-post-by-student')->with([
                'post'  =>  $post,
                'comments'  =>  $comments,
           ]);
        }else{
            abort(404);
        }
       
     }





    public function destroy($id){

        if(Gate::allows('is-student-only')){

            $post = Post::where('id',$id)->getOwnPost(auth::user()->id)->forcedelete();
            return redirect()->back()->with('success','Post has been deleted!');

        }
        
    }


    /* public function restore(){
        $posts = Post::onlyTrashed()->where('user_id',auth::user()->id)->restore();
        if($posts){
            return redirect()->back()->with('success','Your posts have been restored!');
        }else{
            return redirect()->back()->with('warning','No post to be restored!');
        }
       
    } */
}
