<?php

namespace App\Http\Livewire\User;

use App\Models\Rate;
use App\Models\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class MyRequest extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $request_id, $store_rating;

    public function render()
    {
        $requests = Request::with('category')->where('user_id',Auth::user()->id)->paginate(20);
        return view('user.my-request',compact('requests'))
        ->extends('Admin.layouts.master')->section('content');;
    }

    public function showRate($id){
        $this->request_id = $id;
        $this->dispatchBrowserEvent('show-rate-model');
    }

     public function rate()
    {
        try {
            $result = false;

            $store_rating =  ($this->store_rating)/2;
            $rate = new Rate();
            $rate->request_id = $this->request_id;
            $rate->rate = $store_rating;
            $rate->guest_ip = request()->ip();
            $result = $rate->save();
            if($result){
                $this->dispatchBrowserEvent('hide-modal');
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'success',  'message' => 'شكرا لك على تقيييمك']);
                    $this->resetInput();
            }else{
                $this->dispatchBrowserEvent('hide-modal');
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'لقد سبق لك تقييم هذا العمل مُسبقا']);
            }

            // to catch uniqly rating
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => 'لقد سبق لك تقييم هذا العمل مُسبقا']);
        }
    }
    public function resetInput(){
        $this->work_id = '';
        $this->store_rating = '';
    }
}
