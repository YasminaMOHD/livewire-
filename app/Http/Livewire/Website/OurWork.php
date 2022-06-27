<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;

class OurWork extends Component
{
    public function render()
    {
        return view('website.work')->extends('website.layouts.master')
        ->section('content');
    }
}
