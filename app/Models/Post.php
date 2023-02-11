<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getStudent(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function getCategory(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function scopeGetOwnPost($query,$param){
        return $query->where('user_id',$param);
    }

    public function scopeGetPersonal($query){
        return $query->where('category_id',1);
    }

    public function scopeGetAcademic($query){
        return $query->where('category_id',2);
    }

    public function scopeGetCareer($query){
        return $query->where('category_id',3);
    }

   public function scopeIsPrivate($query,$param){
        return $query->whereNotNull('private')->where('id',$param);
   }

    public function scopeGetPrivatePost($query,$param){
        return $query->where('private','=',$param);
    }

    public function getComments(){
        return $this->hasMany('App\Models\Comment','post_id','id')->orderBy('created_at','desc');
    }

    public function privateTo(){
        return $this->belongsTo('App\Models\User','private','id');
    }

    public function scopePrivate($q,$param){
        return $q->whereNotNull('private')->where('id',$param);
    }

   
}

