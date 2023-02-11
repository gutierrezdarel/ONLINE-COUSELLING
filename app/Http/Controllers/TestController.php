<?php

namespace App\Http\Controllers;

use App\Models\TestModel;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
        return md5('testing');
    }
    public function test2(){

        $test = TestModel::where('id',5)->get();

        return view('sample2')->with('data',$test);
    }
}

