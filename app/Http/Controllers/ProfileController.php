<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use App\Rules\MatchOldPassword;
use auth;
use Validator;

class ProfileController extends Controller
{
    public function edit(){
        return view('profile')->with([
            'user' => auth::user(),
        ]);
    }

    public function uploadAvatar(Request $request, $id){

        $messages = array(
           'avatar.required'    =>  'Please choose file'
        );
        $rules = array(
            'avatar'  =>    'required|image',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        if($request->hasFile('avatar')){
            // Get filename with the extension
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('avatar')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('avatar')->storeAs('public/images/avatar', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $user = User::findorFail($id);
        $user->avatar = $fileNameToStore;
        $user->save();
        //\Session::flash('success', __('Image has been uploaded!')); 
        return response()->json(['success' => true,'status'=>'success']);
    }
    
    //change own account password
    public function changePass(Request $request){
        $messages = array(
           
         );

         $rules = array(
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', Password::defaults()],
            'confirm_password' => ['same:new_password'],
         );
 
         $validator = Validator::make($request->all(),$rules ,$messages);
 
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return redirect()->back()->with('success','Password has been successfully changed!');
    }

    public function update(Request $request){
        $messages = array(
           
        );
        $rules = array(
           'name'   =>  'required|string',
           'email'   =>  'required|email|unique:users,email,'.auth::user()->id.',id,deleted_at,NULL',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $user = User::findOrFail(auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;

        if($user->isDirty()){
            $user->save();
            
            \Session::flash('success', __('Profile has been updated!')); 
            return response()->json(['status' => true]);
        }else{
            
            \Session::flash('warning', __('No changes!')); 
            return response()->json(['status' => true]);
        }
        
    }
}
