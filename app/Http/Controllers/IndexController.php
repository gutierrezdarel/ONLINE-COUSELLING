<?php

namespace App\Http\Controllers;

use App\Models\AboutTitle;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Common;
use App\Models\Mission;
use App\Models\ServiceTitle;
use App\Models\Vision;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){ 

    
        return view('index')->with([

            'mission' => Mission::all()->first(),
            'vision'   =>  Vision::all()->first(),
            'common'    =>  Common::all()->first(),
            'banner'    =>  Banner::all()->first(),
            'categories'  =>  Category::all(),
            'serviceTitle'  =>  ServiceTitle::all()->first(),
            'about' =>  AboutTitle::all()->first(),
            'guidances' =>  User::whereDoesntHave('roles', function($q){
                                $q->where('role','Admin');
                            })->WhereHas('roles', function($q){
                                $q->where('role','Guidance');
                            })
                            ->inRandomOrder()
                            ->paginate(2),
        ]);
    }
}
