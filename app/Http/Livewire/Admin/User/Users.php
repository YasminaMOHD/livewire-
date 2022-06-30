<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Users extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use AuthorizesRequests;

    public $user;
    public $user_id;
    public $name;
    public $email;
    public $phone;

    protected $listeners = [
        'delete' => 'destroy'
    ];

    public function render()
    {
        $this->authorize('view-user', User::class);
        $users = User::where('user_type','user')->orderBy('id','desc')->paginate(20);

        return view('Admin.users',['users'=>$users])
        ->extends('Admin.layouts.master')
        ->section('content');
    }

    public function showConfirm($id){
        $this->user_id=$id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }

    public function destroy(){
        $this->authorize('delete-user', User::class);
         try{
             $user = User::findOrFail($this->user_id);
             $user = $user->delete();
              $this->dispatchBrowserEvent('deleted-success');
         }catch(Exception $e){
            $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => $e->getMessage()]);
        }
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
    }
}
