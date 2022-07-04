<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Favorite;
use Livewire\WithPagination;
use App\Http\Traits\AddFavorites;
use Illuminate\Support\Facades\Auth;

class Favorites extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use AddFavorites;
    public function render()
    {
        $works = Favorite::with('work')->where('user_id',Auth::user()->id)->paginate(20);
        return view('user.favorites',compact('works'))
        ->extends('Admin.layouts.master')->section('content');
    }

    public function addFavorote($id){
        $this->index($id);
        $this->render();
    }
}
