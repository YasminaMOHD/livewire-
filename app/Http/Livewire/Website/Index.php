<?php

namespace App\Http\Livewire\Website;

use App\Models\Content;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $content = Content::first();
        return view('website.index',compact('content'))
        ->extends('website.layouts.master')->section('content');
    }
}
