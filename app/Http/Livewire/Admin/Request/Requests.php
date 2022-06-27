<?php

namespace App\Http\Livewire\Admin\Request;

use App\Models\Request;
use Livewire\Component;
use App\Models\Category;
use App\Models\Description;
use Illuminate\Support\Facades\Auth;

class Requests extends Component
{
    public $search , $request , $category , $employee , $status , $delivryTime , $description;

    public function render()
    {
        $requests = Request::with('user')->with('guset')->with('category')
        ->with('employee')->with('desc')->orderBy('id','desc')->paginate(20);
        $categories = Category::get();
        return view('livewire.admin.request.requests' , compact('requests','categories'))
        ->extends('Admin.layouts.master')
        ->section('content');
    }

    public function goToAssign($id)
    {
        $request = Request::findOrFail($id);
        $this->request = $request;
        $this->employee = $request->employee_id;
        $this->dispatchBrowserEvent('showHistory');
    }
    public function assign(){
        $this->request->employee_id = $this->employee;
        $save = $this->request->save();
       if($save){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'success',  'message' => 'تم تعيين الموظف للعمل على الطلب بنجاح']);
       }else{
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => 'خطا عند تعيين الموظف للقيام بالعمل ، حاول مرة أخرى']);
       }

        $this->assetResetInput();
        $this->dispatchBrowserEvent('hide-modal');
        }

    public function assetResetInput()
    {
        $this->employee = '';
    }

    public function update($id){
        $request = Request::findOrFail($id);
        $this->request = $request;
        $this->status = $request->status;
        $this->delivryTime = $request->delivery_time;
        $this->dispatchBrowserEvent('controlWork');
    }
    public function edit(){
        if($this->description != null){
            $desc = Description::create([
                'request_id' => $this->request->id,
                'user_id' => Auth::user()->id,
                'text' => $this->description
            ]);
        }
        $this->request->status = $this->status;
        $this->request->delivery_time = $this->delivryTime;
        $save = $this->request->save();
        if($save){
            $this->dispatchBrowserEvent('alert',
                    ['type' => 'sucess',  'message' => 'تم تعديل الطلب / إضافة ملاحظات  بنجاح']);
        }else{
            $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'حدث خطأ أثناء تعديل حالة الطلب ، حاول مرة أخرى']);
        }
        $this->resetInput();
        $this->dispatchBrowserEvent('hide-modal');

    }

    public function resetInput(){
        $this->status = '';
        $this->delivryTime = '';
        $this->description = '';
    }


}
