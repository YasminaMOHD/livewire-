<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('index')
        ->extends('website.layouts.master')->section('content');
    }
}
