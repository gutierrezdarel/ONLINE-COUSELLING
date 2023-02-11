<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUserPrimaryRole()
    {
        return $this->belongsToMany('App\Models\Role','role_users', 'user_id', 'role_id')->orderBy('role_id','asc')->first();
    }
    public function roles(){
        return $this->belongsToMany('App\Models\Role','role_users', 'user_id', 'role_id');
    }

    public function getPosts(){
        return $this->hasMany('App\Models\Post','user_id','id');
    }

    public function getPrivatePosts(){
        return $this->hasMany('App\Models\Post','private','id');
    }

    public function getSection(){
        return $this->belongsTo('App\Models\Section','section_id','id');
    }

    public function scopeNotSelf($query,$id){
        return $query->where('id','!=',$id);
    }

    public function isSuperAdmin(){
        $user = auth::user()->roles->pluck('role');
        if($user->contains('Super-Admin')){
            return true;
        }  
    }

    public function isAdmin(){
        $user = auth::user()->roles->pluck('role');
        if($user->contains('Admin')){
            return true;
        }
         
    }

    public function isAdminOnly(){
        $user = auth::user()->roles->pluck('role');
        if(!$user->contains('Super-Admin') && $user->contains('Admin')){
            return true;
        }
         
    }




    public function isGuidance(){
        $user = auth::user()->roles->pluck('role');
        if($user->contains('Guidance')){
            return true;
        }  
    }
    public function isGuidanceOnly(){
        $user = auth::user()->roles->pluck('role');
        if(!$user->contains('Admin') && $user->contains('Guidance')){
            return true;
        }  
    }

    public function isStudent(){
        $user = auth::user()->roles->pluck('role');
        if($user->contains('Student')){
            return true;
        }  
    }

    public function isStudentOnly(){
        $user = auth::user()->roles->pluck('role');
        if(!$user->contains('Guidance')){
            return true;
        }  
    }

    public function canViewPosts(){
        $user = auth::user()->roles->pluck('role');
        if(!$user->contains('Admin') && $user->contains('Student')){
            return true;
        }  
    }

    public function gotDeactivated(){
        return $this->belongsTo('App\Models\ReactivatedUsers','user_id','id');
    }
    

  
    
}
