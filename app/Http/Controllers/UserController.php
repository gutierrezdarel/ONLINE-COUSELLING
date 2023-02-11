<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Role;
use App\Models\InviteUser;
use App\Models\RoleUser;
use App\Mail\UserInvitation;
use App\Mail\AccountReactivationStudentNotif;
use App\Models\ReactivatedUsers;
use App\Models\Section;
use auth;


class UserController extends Controller
{
    public function __construct()
    {
        
        $this->sections = Section::all();
        $this->roles = Role::all();
    }

    public function index(){
       
        if(Gate::allows('is-superadmin')){
            $roles = $this->roles;
            $users = User::has('roles')->NotSelf(auth::user()->id)->get();
        }
        if(Gate::allows('is-admin-only')){
            $roles = Role::where('id','>',3)->get();
            $users =  User::whereDoesntHave('roles', function($q){
                            $q->where('role','Guidance');
                        })->WhereHas('roles', function($q){
                            $q->where('role','Student');
                        })->get();
        }

        return view('admin-user-management')->with([
            'users' => $users,
            'roles' =>  $roles,
            'sections'  =>  $this->sections,
        ]);
      
    }

    public function store(Request $request){
        $messages = array(
            'role.integer'  =>  'Invalid format.',
            'student_section.required_if'   =>  'Please select student section.'
        );

        $rules = array(
            'name'  =>    'required|string',
            'email'   =>  'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'role'  =>  'required|integer',
            'student_section'   =>  'required_if:role,4',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(Gate::allows('is-admin-only')){
            if(!empty($request->role) && $request->role != 4){
                abort(404);
            }
        }

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
              
        $token = str_replace('/','',Hash::make(bin2hex(openssl_random_pseudo_bytes(248))));
        $requestedEmail = $request->email;
        $checkUser = InviteUser::where('email',$requestedEmail)->first();

        if($checkUser){
            $checkUser->delete();
        }

        if($request->role != 4){
            $section = 0;
        }else{
            $section = $request->student_section;
        }

        //insert to invite_users table
        $newInvitation = new InviteUser();
        $newInvitation->name = $request->name;
        $newInvitation->section_id = $section;
        $newInvitation->role_id = $request->role;
        $newInvitation->email = $requestedEmail;
        $newInvitation->token = $token;
        $newInvitation->invited_by = auth::user()->id;
        $newInvitation->save();

        //sending invitation to users
        $check = InviteUser::where('email',$requestedEmail)->first();
        if($check){
            $email = [$check->email];
            $name = $check->name;
            $token = $check->token;
            Mail::to($email)->send(new UserInvitation($name, $token));
        }else{
            return redirect()->back()->with('error','Something went wrong, please contact your System Administrator!');
        }

        return response()->json(['success' => true]);
       
          
    }

    public function disable($id){
        if(Gate::allows('is-admin')){
            
            $user = User::where('id',$id)->first();
            $checkRole = $user->roles->pluck('role');
            
            if($id == auth::user()->id){
                return redirect()->back()->with('error','You do not have permission to disabled your own account!');
            }

            if(Gate::allows('is-admin-only')){
                if(!$checkRole->contains('Super-Admin')){
                    $user->status = 0;
                    $user->save();
                    return redirect()->back()->with('success','User has been disabled');
                }else{
                    return redirect()->back()->with('error','You do not have permission to disabled the user!');
                }
            }

            if(Gate::allows('is-superadmin')){
                $superadmins =  User::whereHas('roles', function($q){
                                $q->where('role','Super-Admin');
                            })
                            ->where('status',1)
                            ->count();
                if($checkRole->contains('Super-Admin')){
                    if($superadmins > 2){
                        $user->status = 0;
                        $user->save();
                        return redirect()->back()->with('success','User has been disabled');
                    }else{
                        return redirect()->back()->with('error','Unable to disable that account. Make sure that you have 3 or more super-admin!');
                    }
                }else{
                    $user->status = 0;
                    $user->save();
                    return redirect()->back()->with('success','User has been disabled');
                }
            }
           
        }
    }

    public function enable($id){
        if(Gate::allows('is-admin')){
            
            $user = User::where('id',$id)->first();
            $checkRole = $user->roles->pluck('role');
            
            if($id == auth::user()->id){
                return redirect()->back()->with('error','You do not have permission to disabled your own account!');
            }

            if(Gate::allows('is-admin-only')){
                if(!$checkRole->contains('Super-Admin')){
                    $user->status = 1;
                    $user->save();
                    return redirect()->back()->with('success','User has been enabled!');
                }else{
                    return redirect()->back()->with('error','You do not have permission to enable this user!');
                }
            }
            if(Gate::allows('is-superadmin')){
                $user->status = 1;
                $user->save();
                return redirect()->back()->with('success','User has been disabled');
            }
           
        }
    }

    public function newUserChangePass($token){
        $check = InviteUser::where('token',$token)->first();
        if($check){
           if(!$check->created_at->isToday()){
                return abort(419);
           }else{
                return view('auth.passwords.create-password')->with('token',$token);
           }
        }else{
            abort(404);
        }
    }
     //Activating user by changind password once received the email. 
     public function newUserActivate(Request $request){
        
        $request->validate([
            'password' => ['required',Password::defaults()],
            'password_confirmation' => ['same:password'],           
        ]);

        $check = InviteUser::where('token',$request->token)->first();
        $roles = $this->roles;

        if($check){

            $assignedRole = $check->role_id;

            //check invitation expiration within the day
            if($check->created_at->isToday()){
                $newUser = new User();
                $newUser->name = $check->name;
                $newUser->status = 1;
                $newUser->section_id = $check->section_id;
                $newUser->email = $check->email;
                $newUser->avatar = 'noimage.jpg';
                $newUser->password = Hash::make($request->password);
                $newUser->save();
                $check->delete();

                 //insert assigned role
                $checkNewUser = User::where('email',$check->email)->first();
                foreach($roles as $role){
                   if($assignedRole <= $role->id){
                        $newRole = new RoleUser();
                        $newRole->user_id = $checkNewUser->id;
                        $newRole->role_id = $role->id;
                        $newRole->save();
                    }
                }
                return redirect(route('login'))->with('success','Password has been successfully set!');           
            }else{
                return abort(419);
            }
        }else{
            return abort(419);
        }
    }

    Public function deactivate(){
        $user = User::findOrFail(auth::user()->id);
        
        $markAsDeact = new ReactivatedUsers();
        $markAsDeact->user_id = $user->id;
        $markAsDeact->save();

        if($user->getPosts){
          $user->getPosts()->delete();
        }
        $user->delete();
        Auth::logout();
        return redirect('/login')->with('warning','Your account has been deactivated!');
    }

    //User deactivation own account
    public function deactivatedStudents(){
        return view('deactivated-students')->with([
            'users' =>  User::onlyTrashed()->get(),
        ]);
    }

    //super admin activating student account
    public function reactivateStudents($id){

        $user = User::onlyTrashed()->find($id)->restore();
        $user = User::findOrFail($id);
        $name = $user->name;
        $email = $user->email;

        Mail::to($user->email)->send(new AccountReactivationStudentNotif($name,$email));
        
        return redirect()->back()->with('success','User has been reactivated!');
    }

    public function edit($id){

        if(Gate::allows('is-superadmin')){
            $roles = Role::all();
        }
        if(Gate::allows('is-admin-only')){
            $roles = Role::where('id','>',3)->get();
        }

        $user = User::findOrFail($id);

        $html = view('partials.edit-role-section')->with(['roles'=>$roles,'sections'=>$this->sections,'user'=>$user])->render();
        
        $data = array(
            'user'  =>  $user,
            'html'  =>  $html,
        );

        return response()->json($data);
    }

    public function update(Request $request){
        $id = $request->user_id;
        $user = User::findOrFail($id);

        $messages = array(
            'role.integer'  =>  'Invalid format.',
            'student_section.required_if'   =>  'Please select student section.'
        );
        $rules = array(
            'name'  =>    'required|string',
            'email'   =>  'required|email|unique:users,email,'.$user->id.',id,deleted_at,NULL',
            'role'  =>  'required|integer',
            'student_section'   =>  'required_if:role,4',
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }


       
        $checkRole = $user->roles->pluck('role');
        $roleChange = false;

        $user->name = $request->name;
        $user->email = $request->email;

        //editing own account
        if($id == auth::user()->id){

            \Session::flash('error', __('Something went wrong!')); 
            return response()->json(['status' => true]);
        }

        if(Gate::allows('is-admin-only')){
            if(!$checkRole->contains('Guidance')){
                
                if($request->role == 4){
                    $user->section_id = $request->student_section;

                    $newRole = new RoleUser();
                    $newRole->user_id = $user->id;
                    $newRole->role_id = 4;
                    $newRole->save();
                    $roleChange = true;

                }else{
                    return abort(404);
                }

            }else{
                \Session::flash('error', __('You do not have enough permission to edit Super-admin account!')); 
                return response()->json(['status' => true]);
            }
        }

        if(Gate::allows('is-superadmin')){

            if($request->role == 4){
                $user->section_id = $request->student_section;
            }else{
                $user->section_id = 0;
            }

                //Update User roles
            if($user->getUserPrimaryRole()->id != $request->role){

                $user->roles()->each(function($role){
                    $role->pivot->delete(); 
                });

                foreach($this->roles as $role){
                    if($request->role <= $role->id){
                        $newRole = new RoleUser();
                        $newRole->user_id = $user->id;
                        $newRole->role_id = $role->id;
                        $newRole->save();
                        $roleChange = true;
                    }
                }
            }
            
        }

        
        //saving user info if changes made
        if($user->isDirty() || $roleChange==true){
            $user->save();
            \Session::flash('success', __('User has been updated!')); 
            return response()->json(['status' => true]);
        }else{
            \Session::flash('warning', __('No changes made!')); 
            return response()->json(['status' => true]);
        }


    }
}
