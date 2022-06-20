<?php

namespace App\Models;

use App\Models\Work;
use App\Models\Manger;
use App\Models\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,SoftDeletes ;
    protected $guarded=[];

    public function manger(){
        return $this->hasMany(Manger::class);
    }

    public function work(){
        return $this->hasMany(Work::class);
    }

    public function request(){
        return $this->hasMany(Request::class);
    }
}
