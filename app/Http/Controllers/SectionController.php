<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Validator;

class SectionController extends Controller
{
    public function getInfo($id){
        return Section::findOrFail($id);
    }


    public function store(Request $request){
        $messages = array(
           'section.unique' =>  'This Section is already exist',
        );
        $rules = array(
            'section'  =>    'required|string|unique:sections,section,NULL,id,deleted_at,NULL',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $section = new Section();
        $section->section = $request->section;
        $section->save();

        \Session::flash('success', __('Section has been added successfully!')); 
        return response()->json(['success' => true]);
    }


    public function update(Request $request){

        $messages = array(
            'section.unique' =>  'This Section is already exist',
        );
        $rules = array(
            'section'  =>    'required|string|unique:sections,section,'.$request->section_id.',id,deleted_at,NULL',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $section = Section::findOrFail($request->section_id);
        $section->section = $request->section;

        if($section->isDirty()){
            $section->save();
            \Session::flash('success', __('Section has been updated successfully!')); 
            return response()->json(['success' => true]);
        }else{
            \Session::flash('warning', __('No changes made!')); 
            return response()->json(['success' => true ]);
        }
    }

    public function destroy($id){
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->back()->with('success','Section has been deleted!');
    }
}
