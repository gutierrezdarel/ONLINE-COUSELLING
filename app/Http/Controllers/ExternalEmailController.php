<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Inquiry;
use App\Models\InquiryReceiver;
use Validator;

class ExternalEmailController extends Controller
{
    public function send(Request $request){
        $messages = array(
            
        );
        $rules = array(
            'name'  =>    'required|string',
            'email'  =>    'required|email',
            'section' =>    'required',
            'number'  =>    'required',
            'message'   =>  'required|string'
           
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $receivers = InquiryReceiver::all();

        $emails = array();

        foreach($receivers as $receiver){
            array_push($emails,$receiver->email);
        }

        
        $emailTo = $emails;
        $name = $request->name;
        $email = $request->email;
        $section = $request->section;
        $number = $request->number;
        $message = $request->message;

        Mail::to($emailTo)->send(new Inquiry($name,$email,$section,$number,$message));
         return redirect()->back()->with('success','sent');
    }

    public function receivers(){
        $receivers = InquiryReceiver::all();
        return view('inquiry-receiver')->with([
            'receivers' =>  $receivers,
        ]);
    }

    public function store(Request $request){
        $messages = array(
            'email.unique'  =>  'Duplicate email, try unique email address.'
        );
        $rules = array(
            'email'   =>  'required|email|unique:inquiry_receivers,email,NULL,id,deleted_at,NULL',
           
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $email = new InquiryReceiver();
        $email->email = $request->email;
        $email->save();

        \Session::flash('success', __('Recipient has been added!')); 
        return response()->json(['status' => true]);

    }

    public function getInfo($id){
        $receiver = InquiryReceiver::findOrFail($id);
        return response()->json($receiver);
    }

    public function update(Request $request){

        $messages = array(
            'email.unique'  =>  'Duplicate email, try unique email address.'
        );
        $rules = array(
            'email'   =>  'required|email|unique:inquiry_receivers,email,'.$request->email_id.',id,deleted_at,NULL',
           
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $receiver = InquiryReceiver::findOrFail($request->email_id);

        $receiver->email = $request->email;

        if($receiver->isDirty()){
            $receiver->save();
            \Session::flash('success', __('Recipient has been updated!')); 
            return response()->json(['status' => true]);
    
        }else{
            \Session::flash('warning', __('No changes!')); 
            return response()->json(['status' => true]);
    
        }
    }

    public function destroy($id){
        $receiver = InquiryReceiver::findOrFail($id);
        $receiver->delete();
        return redirect()->back()->with('success','Recipient has been removed!');

    }

   
}
