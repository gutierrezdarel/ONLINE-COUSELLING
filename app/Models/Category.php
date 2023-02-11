<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getPosts(){
        return $this->hasMany('App\Models\Post','category_id','id');
    }
    public function scopeGetPersonal($query){
        return $query->where('id',1);
    }
    public function scopeGetAcademic($query){
        return $query->where('id',2);
    }
    public function scopeGetCareer($query){
        return $query->where('id',3);
    }
}
