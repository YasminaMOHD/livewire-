<?php

namespace App\Models;

use App\Models\User;
use App\Models\Guset;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Description;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Request extends Model
{
    use HasFactory,SoftDeletes ;
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function guset(){
        return $this->belongsTo(Guset::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function desc(){
        return $this->hasMany(Description::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
