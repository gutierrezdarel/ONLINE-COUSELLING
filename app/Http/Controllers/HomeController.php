<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if(Gate::allows('is-guidance-only')){
            return view('home')->with([
                'posts'  =>  Post::orderBy('created_at','desc')
                                ->whereNull('private')
                                ->orWhere('private',auth::user()->id)
                                ->paginate(10),
                'categories'    =>  Category::all(),
                'filterStudents' =>  User::whereDoesntHave('roles', function($q){
                                $q->where('role','Guidance');
                                })->WhereHas('roles', function($q){
                                    $q->where('role','Student');
                                })->get(),
            ]);
        }

        if(Gate::allows('is-student-only')){
            
        
                return view('home')->with([
                'posts' =>  auth::user()->getPosts()->orderBy('created_at','desc')->get(),
                'guidances' =>  User::whereDoesntHave('roles', function($q){
                                    $q->where('role','Admin');
                                })->WhereHas('roles', function($q){
                                    $q->where('role','Guidance');
                                })->get(),
                'personalCount'  =>  auth::user()->getPosts()->getPersonal()->count(),
                'academicCount'  =>  auth::user()->getPosts()->getAcademic()->count(),
                'careerCount'  =>  auth::user()->getPosts()->getCareer()->count(),
            ]);
        }

        if(Gate::allows('is-admin')){
            
            return view('admin-dashboard')->with([
                'totalPosts'    =>  Post::all()->count(),
                'totalPostsWithComments'    =>  Post::has('getComments')->count(),
                'countPersonal' =>  Post::GetPersonal()->count(),
                'countAcademic' =>  Post::GetAcademic()->count(),
                'countCareer' =>  Post::GetCareer()->count(),
                'guidances' =>  User::whereDoesntHave('roles', function($q){
                                    $q->where('role','Admin');
                                })->WhereHas('roles', function($q){
                                    $q->where('role','Guidance');
                                })->paginate(4),
            ]);
        }
    }

}
