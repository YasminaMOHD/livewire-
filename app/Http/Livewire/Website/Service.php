<?php

namespace App\Http\Livewire\Website;

use App\Models\User;
use App\Models\Guset;
use App\Models\Request;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class Service extends Component
{
    public $name , $email , $phone , $otherInfo , $category , $duration , $project_name ;

   public $rules = [
         'name' => 'required',
         'email' => 'required|email',
         'phone' => 'required',
         'category' => 'required',
         'duration' => 'required',
         'project_name' => 'required',
   ];
   public $messages = [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.email' => 'البريد الالكتروني غير صحيح',
            'phone.required' => 'رقم الهاتف مطلوب',
            'category.required' => 'الفئة مطلوبة',
            'duration.required' => 'المدة مطلوبة',
            'project_name.required' => 'اسم المشروع مطلوب',
    ];

    public function render()
    {
        if(Auth::check()){
            $this->name = Auth::user()->name;
            $this->email = Auth::user()->email;
            $this->phone = Auth::user()->phone;
        }
        $categories = Category::get();
        return view('website.service' , compact('categories'))->extends('website.layouts.master')
        ->section('content');
    }

    public function store(){
        $this->validate($this->rules);
        try{
        //  status 0 request new
        //  status 1 request responce معلقة
        //  status 2 request approve
        //  status 3 request is reject
        //  status 4 request is قيد التنفيذ
        //  status 5 request is مكتملة

        $request = new Request();
        $guset=null;
        if(Auth::check()){
            $request->user_id = Auth::user()->id;
        }else{
            $guset = Guset::where('email',$this->email)->where('name',$this->name)
            ->where('phone',$this->phone)->first();
            if($guset != null ){
                $request->guset_id = $guset->id;
            }else{
                $guset = new Guset();
                $guset->name = $this->name;
                $guset->email = $this->email;
                $guset->phone = $this->phone;
                $guset->save();
                $request->guset_id = $guset->id;
            }
        }
            $request->project_name =  $this->project_name;
            $request->duration = $this->duration;
            $request->otherInfo =  $this->otherInfo;
            $request->category_id =  $this->category;
            $request->status =  0;

            $request = $request->save();
            if($request){
                $this->resetInputs();
                $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'تم ارسال الطلب بنجاح']);
            }else{
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'حدث خطأ أثناء إرسال الطلب ، حاول مرة أخرى']);
                Guset::where('id', $guset->id)->delete();
            }
    }catch(Exception $e){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => $e->getMessage()]);
    }
}

public function resetInputs(){
    $this->name = "";
    $this->email = "";
    $this->phone = "";
    $this->otherInfo = "";
    $this->category = "";
    $this->duration = "";
    $this->project_name = "";
}
}
