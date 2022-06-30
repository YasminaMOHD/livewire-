<?php

namespace App\Http\Livewire\Website;

use App\Models\Rate;
use App\Models\Work;
use Livewire\Request;
use Livewire\Component;
use App\Models\Favorite;
use App\Http\Traits\AddFavorites;
use Illuminate\Support\Facades\Auth;

class OurWork extends Component
{
    use AddFavorites;
    public $work_id=-1, $store_rating;

    public function render()
    {
        $works= Work::whereIn('status',[0,2])->paginate(20);
        return view('website.work',['works'=>$this->filter($this->work_id)])->extends('website.layouts.master')
        ->section('content');
    }

    public function addFavorote($id){
        $this->index($id);
    }
    public function showRate($id){
        $this->work_id = $id;
        $this->dispatchBrowserEvent('show-rate-model');
    }

    public function filter($id){
        $this->work_id = $id;
        $check = false;
        if($this->work_id == -1){
           $works = Work::whereIn('status',[0,2])->paginate(20);
        }else{
            $check = true;
            $works = Work::whereIn('status',[0,2])->where('category_id',$this->work_id)->paginate(20);
            // dd($works);
        }
        $this->dispatchBrowserEvent('active',['id'=>$id,'checkAll'=>$check]);
        return $works;
    }

    // public function rate()
    // {
    //     try {
    //         $result = false;

    //         $store_rating =  ($this->store_rating)/2;
    //         $rate = new Rate();
    //         $rate->work_id = $this->work_id;
    //         $rate->rate = $store_rating;
    //         $rate->guest_ip = request()->ip();
    //         $result = $rate->save();
    //         if($result){
    //             $this->dispatchBrowserEvent('hide-modal');
    //             $this->dispatchBrowserEvent('alert',
    //                 ['type' => 'success',  'message' => 'شكرا لك على تقيييمك']);
    //                 $this->resetInput();
    //         }else{
    //             $this->dispatchBrowserEvent('hide-modal');
    //             $this->dispatchBrowserEvent('alert',
    //                 ['type' => 'error',  'message' => 'لقد سبق لك تقييم هذا العمل مُسبقا']);
    //         }

    //         // to catch uniqly rating
    //     } catch (\Illuminate\Database\QueryException $ex) {
    //         $this->dispatchBrowserEvent('hide-modal');
    //         $this->dispatchBrowserEvent('alert',
    //                 ['type' => 'error',  'message' => 'لقد سبق لك تقييم هذا العمل مُسبقا']);
    //     }
    // }

    public function resetInput(){
        $this->work_id = '';
        $this->store_rating = '';
    }
    // private function lsq($store_id)
    // {
    //     $rates_ordered = Rate::where('store_id', $store_id)->orderBy('created_at')->get()->toArray();
    //     // dd($rates_ordered);
    //     if (sizeof($rates_ordered) > 1) {
    //         $X = array(); // created_at
    //         $Y = array(); // rate

    //         foreach ($rates_ordered as $rate) {
    //             $X[] = strtotime($rate['created_at']);
    //             $Y[] = (int)$rate['rate'];
    //         }

    //
}
