<?php
namespace App\Http\Traits;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

trait AddFavorites {
    public function index($id) {
        if(Auth::check()){
            $check = Favorite::where('user_id',Auth::user()->id)->where('work_id',$id)->first();
            if($check){
                $check->delete();
            }else{
            $add = new Favorite();
            $add->user_id = Auth::user()->id;
            $add->work_id = $id;
            $add->save();
            }
        }else{
            $this->dispatchBrowserEvent('alert',
               ['type' => 'warning',  'message' => 'عليك تسجيل الدخول لتتمكن من الإضافة الى المفضلة']);

    }
    }
}
