<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('website.about')->extends('website.layouts.master')
        ->section('content');
    }
}
