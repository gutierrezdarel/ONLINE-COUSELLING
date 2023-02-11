<?php

namespace App\Http\Controllers;

use App\Models\TermCondition;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;


class TermsConditionController extends Controller
{
    public function accept(){
        \Session::put('privacy',0);
        return redirect()->back()->with('success','Terms and Conditions has been accepted!');
    }

    public function edit($id){
        
        $term = TermCondition::findOrFail($id);
        return view('term-condition-edit')->with([
            'term'  =>  $term,
        ]);
    }

    public function update(Request $request, $id){
        $term = TermCondition::findOrFail($id);
        $term->desc = $request->desc;
        $term->save();
        return redirect()->back()->with('success','Updated!');
    }
}
