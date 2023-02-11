<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testsampleController extends Controller
{

	public function testSample(){
		return view('testsample'); //yung testsample ay yung testsample.blade.php file
    }
}
