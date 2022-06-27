<?php

namespace App\Http\Livewire\Admin\Content;

use App\Models\Content;
use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Contents extends Component
{
    public $content;
    public $whatOffer;
    public $OurMessage;
    public $whoWe;
    public $mechanismWork;
    public $reqex = '<p><br></p>';
    protected $rules = [
        'whatOffer' =>"required",
        'OurMessage' => "required",
        'whoWe' => "required",
        'mechanismWork' => "required",
    ];
    protected $messages = [
        'whatOffer.required' => '* هذا الحقل مطلوب',
        'OurMessage.required' => '* هذا الحقل مطلوب',
        'whoWe.required' => '* هذا الحقل مطلوب',
        'mechanismWork.required' => '* هذا الحقل مطلوب',
    ];




    public function mount()
    {
        $this->content = Content::first();
        $this->whatOffer = $this->content->whatOffer;
        $this->OurMessage = $this->content->OurMessage;
        $this->whoWe = $this->content->whoWe;
        $this->mechanismWork = $this->content->mechanismWork;
    }

    public function render()
    {
        return view('livewire.admin.content.contents',['content' => $this->content])
        ->extends('Admin.layouts.master')
        ->section('content');

       ;
    }

    public function update(){
        $validate = $this->validate($this->rules);
       if($validate){
            $con = Content::first();
            if($con){
            $content = $con->update(
               [
                   'whatOffer' => $this->whatOffer,
                   'OurMessage' => $this->OurMessage,
                   'whoWe' => $this->whoWe,
                   'mechanismWork' => $this->mechanismWork,
               ]
           );
             if($content){
                $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'تم تحديث المحتوى بنجاح']);                $this->emitself('refresh-me');
             }else{
                $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => 'حدث خطأ ما ، حاول مرة أخرى']);

             }
            // return redirect()->route('admin.content');
        }
    }else{
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => 'حدث خطأ ما ، حاول مرة أخرى وتأكد من البيانات المدخلة']);
    }
        }
}
