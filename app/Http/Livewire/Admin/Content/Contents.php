<?php

namespace App\Http\Livewire\Admin\Content;

use App\Models\Content;
use Livewire\Component;

class Contents extends Component
{
    public $content;
    public $whatOffer;
    public $OurMessage;
    public $whoWe;
    public $mechanismWork;
    public $reqex = '<p><br></p>';
    protected $rules = [
        'whatOffer' =>"required|max:700|not_in:<p><br></p>",
        'OurMessage' => "required|max:700|not_in:<p><br></p>",
        'whoWe' => "required|max:700|not_in:<p><br></p>",
        'mechanismWork' => "required|max:700|not_in:<p><br></p>",
    ];
    protected $listeners = [
        'refresh-me' => '$refresh'
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
        $this->validate();
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
            session()->put('success','تم تعديل محتوى الموقع بنجاح');

            $this->emitself('refresh-me');
            // return redirect()->route('admin.content');
        }
        }
}
