<?php

namespace App\Http\Controllers;

use App\Models\AboutTitle;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Common;
use App\Models\Mission;
use App\Models\ServiceTitle;
use App\Models\Vision;
use Illuminate\Support\Facades\Gate;
use Validator;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        
        return view('manage-page')->with([
            'mission' => Mission::all()->first(),
            'vision'   =>  Vision::all()->first(),
            'common'    =>  Common::all()->first(),
            'banner'    =>  Banner::all()->first(),
            'categories'  =>  Category::all(),
            'serviceTitle'  =>  ServiceTitle::all()->first(),
            'about' =>  AboutTitle::all()->first(),
            'mission'   =>  Mission::all()->first(),
            'vision'    =>  Vision::all()->first(),
            'common'    =>  Common::all()->first(),
            'personal'  =>  Category::getPersonal()->first(),
            'academic'  =>  Category::getAcademic()->first(),
            'career'  =>  Category::getCareer()->first(),
        ]);
    }

    //Get about info,about, mission, vision, common
    public function getAboutInfo($idType){

        $strCut = explode('-', $idType);
        $id = implode('-', array_slice($strCut, 1, 1));
        $type = implode('-', array_slice($strCut, 0, 1));

        if($type == 'about'){
            $result = AboutTitle::find($id);
        }
        if($type == 'mission'){
            $result = Mission::find($id);
        }   
        if($type == 'vision'){
            $result = Vision::find($id);
        }
        if($type == 'common'){
            $result = Common::find($id);
        }   

        $html = view('pages.about-form')->with(['result'=>$result,'type'=>$type])->render();

        $data = [
            'html'  =>  $html,
        ];
        
        return response()->json($data,200);


    }
    //update about, mission, vision, common
    public function updateAbout(Request $request){
        $messages = array(
           'about_title.required'   =>  'This field is required',
           'about_desc.required'    =>  'This field is required',
        );
        $rules = array(
            'about_title'  =>    'required|string',
            'about_desc'   =>  'required|string',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $idType = $request->id_type;

        $strCut = explode('-', $idType);
        $id = implode('-', array_slice($strCut, 1, 1));
        $type = implode('-', array_slice($strCut, 0, 1));

        if($type == 'about'){
            $result = AboutTitle::find($id);
        }
        if($type == 'mission'){
            $result = Mission::find($id);
        }   
        if($type == 'vision'){
            $result = Vision::find($id);
        }
        if($type == 'common'){
            $result = Common::find($id);
        } 
        $result->title = $request->about_title;
        $result->desc = $request->about_desc;

        if($result->isDirty()){
            $result->save();
            return response()->json(['success'=>true,'alertText'=>'form-control is-valid','alert'=>'alert alert-block alert-success','message'=>'Record has been updated!','result'=>$result]);
        }else{
            return response()->json(['success'=>true,'alertText'=>'form-control','alert'=>'alert alert-block alert-warning','message'=>'No changes!']);
        }

    }
    //BANNER
    public function updateBanner(Request $request,$id){
        $messages = array(
           
        );
        $rules = array(
            'banner_title'  =>    'required|string',
            'banner_desc'   =>  'required|string',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $banner = Banner::findOrFail($id);
        $banner->title = $request->banner_title;
        $banner->body = $request->banner_desc;

        if($banner->isDirty()){
            $banner->save();
            return response()->json(['success'=>true,'alertText'=>'form-control is-valid','alert'=>'alert alert-block alert-success','message'=>'Banner has been updated!']);
        }else{
            return response()->json(['success'=>true,'alertText'=>'form-control','alert'=>'alert alert-block alert-warning','message'=>'No changes!']);
        }

        
    }

    //Service Title
    public function updateServiceTitle(Request $request, $id){
        $messages = array(
           
        );
        $rules = array(
            'service_title'  =>    'required|string',
            'service_desc'   =>  'required|string',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $service = ServiceTitle::find($id);
        $service->title = $request->service_title;
        $service->description = $request->service_desc;
        if($service->isDirty()){
            $service->save();
            return response()->json(['success'=>true,'alertText'=>'form-control is-valid','alert'=>'alert alert-block alert-success','message'=>'Service title has been updated!']);
        }else{
            return response()->json(['success'=>true,'alertText'=>'form-control','alert'=>'alert alert-block alert-warning','message'=>'No changes!']);
        }
       
    }

    //personal category update
    public function updatePersonal(Request $request, $id){
        $messages = array(
           'category_personal.unique'   =>  'Category is already exist.'
        );
        $rules = array(
            'category_personal'  =>    'required|string|unique:categories,category,'.$id.',id,deleted_at,NULL',
            'category_personal_desc'   =>  'required|string',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $category = Category::find($id);
        $category->category = $request->category_personal;
        $category->description = $request->category_personal_desc;
        $category->icon = $request->category_personal_icon;

        if($category->isDirty()){
            $category->save();
            return response()->json(['success'=>true,'alertText'=>'form-control is-valid','alert'=>'alert alert-block alert-success','message'=>'Category has been updated!']);
        }else{
            return response()->json(['success'=>true,'alertText'=>'form-control','alert'=>'alert alert-block alert-warning','message'=>'No changes!']);
        }

    }

    public function updateAcademic(Request $request, $id){
        $messages = array(
           'category_academic.unique'   =>  'Category is already exist.'
        );
        $rules = array(
            'category_academic'  =>    'required|string|unique:categories,category,'.$id.',id,deleted_at,NULL',
            'category_academic_desc'   =>  'required|string',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $category = Category::find($id);
        $category->category = $request->category_academic;
        $category->description = $request->category_academic_desc;
        $category->icon = $request->category_academic_icon;

        if($category->isDirty()){
            $category->save();
            return response()->json(['success'=>true,'alertText'=>'form-control is-valid','alert'=>'alert alert-block alert-success','message'=>'Category has been updated!']);
        }else{
            return response()->json(['success'=>true,'alertText'=>'form-control','alert'=>'alert alert-block alert-warning','message'=>'No changes!']);
        }

    }

    public function updateCareer(Request $request, $id){
        $messages = array(
           'category_academic.unique'   =>  'Category is already exist.'
        );
        $rules = array(
            'category_career'  =>    'required|string|unique:categories,category,'.$id.',id,deleted_at,NULL',
            'category_career_desc'   =>  'required|string',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $category = Category::find($id);
        $category->category = $request->category_career;
        $category->description = $request->category_career_desc;
        $category->icon = $request->category_career_icon;

        if($category->isDirty()){
            $category->save();
            return response()->json(['success'=>true,'alertText'=>'form-control is-valid','alert'=>'alert alert-block alert-success','message'=>'Category has been updated!']);
        }else{
            return response()->json(['success'=>true,'alertText'=>'form-control','alert'=>'alert alert-block alert-warning','message'=>'No changes!']);
        }

    }
    public function destroyServices(Request $request){

        $idType = $request->type_id;

        if(!Gate::allows('is-admin')){
            \Session::flash('error', __('You do not have enough permission!')); 
            return response()->json(['success' => true]);
        }

        $strCut = explode('-', $idType);
        $id = implode('-', array_slice($strCut, 1, 1));
        $type = implode('-', array_slice($strCut, 0, 1));

        if($type == 'category'){
            $result = Category::findOrFail($id);
            $result->getPosts()->delete();
            $result->delete();
    
            \Session::flash('success', __('Category has been deleted!')); 
            return response()->json(['success' => true]);
        }

        if($type == 'service'){
            $result = ServiceTitle::findOrFail($id);
    
            $result->delete();
    
            \Session::flash('success', __('Service Title has been deleted!')); 
            return response()->json(['success' => true]);
        }

        if($type == 'banner'){
            $result = Banner::findOrFail($id);
    
            $result->delete();
    
            \Session::flash('success', __('Banner has been deleted!')); 
            return response()->json(['success' => true]);
        }
       
    }

}
