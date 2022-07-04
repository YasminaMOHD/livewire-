<?php

namespace App\Http\Livewire\Admin\Manger;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Manger;
use Livewire\Component;
use App\Models\Category;
use App\Models\Roles_Users;
use Livewire\WithPagination;
use App\Events\NewNotification;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Mangers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use AuthorizesRequests;

    public $manger;
    public $manger_id , $user_id;
    public $name;
    public $email;
    public $phone;
    public $category;
    public $password;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|unique:users',
        'phone' => 'required',
        'category' => 'required',
        'password' => 'required',
    ];
    protected $messages = [
        'name.required' => '* الاسم مطلوب',
        'email.required' => '* الايميل مطلوب',
        'email.unique' => '* هذا الايميل يمتلك حساب',
        'phone.required' => '* الهاتف مطلوب',
        'category.required' => '* التصنيف مطلوب',
        'password.required' => '* كلمة السر مطلوبه',
    ];
    protected $listeners = [
        'delete' => 'destroy'
    ];

    public function render()
    {
        $this->authorize('view-manger', Manger::class);
        $categories = Category::get();
        $mangers = Manger::with('user')->with('category')
       ->orderBy('id','desc')->paginate(20);

        return view('Admin.mangers'
        , compact('categories' , 'mangers'))
        ->extends('Admin.layouts.master')
        ->section('content');
    }

    public function store()
    {
        $this->authorize('create-manger', Manger::class);
        $this->validate($this->rules);
        try{
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'user_type' => 'manger'
        ]);
        if($user){
            $manger = null;
            try{
                Roles_Users::create([
                    'user_id' => $user->id,
                    'role_id' => Role::where('name','manger')->first()->id,
                ]);

                $manger = Manger::create([
                    'user_id' => $user->id,
                    'category_id' => $this->category,
                ]);
                 $data =[
                    'title' => "تهانيا ، أنت الإن من ضمن عائلة فور ميديا",
                    'url' => '/4mediapanel'
                ];

        //    ///   save  notify in database table ////

            $user->notify(new SendNotification($data));

            }catch(Exception $e){
                User::where('id', $user->id)->delete();
                $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => $e->getMessage()]);
            }
            if($manger){
                $this->dispatchBrowserEvent('hide-modal');
                $this->resetInputs();
                $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'تم إضافة مدير جديد بنجاح']);
            }else{
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'حدث خطأ أثناء إضافة مدير جديد ، حاول مرة أخرى']);
                User::where('id', $user->id)->delete();
            }
        }
    }catch(Exception $e){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => $e->getMessage()]);
    }
    }

    public function edit($id){
        $this->manger = Manger::with('user')->where('id', $id)->first();
        $this->name = $this->manger ? $this->manger->user->name : "";
        $this->email = $this->manger ? $this->manger->user->email : "";
        $this->phone = $this->manger ? $this->manger->user->phone : "";
        $this->category = $this->manger ? $this->manger->category_id : "";
        $this->password = null;
        $this->manger_id = $id;
        $user = Manger::where('id',$this->manger_id)->first();
        $this->user_id = $user->user_id;

        $this->dispatchBrowserEvent('show-edit-manger');
    }

    public function update(){

        $this->authorize('update-manger', Manger::class);
        $this->validate([
        'name' => 'required',
        'email' => ['required' , Rule::unique('users')->ignore($this->user_id)],
        'phone' => 'required',
        'category' => 'required',
        ]);
        try{
            $user = User::where('id',$this->user_id)->first();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->phone = $this->phone;
            if($this->password != null){
                $user->password = Hash::make($this->password);
            }
        $saveUser = $user->save();
        if($saveUser){
            $manger = Manger::where('id',$this->manger_id)->update([
                'category_id' => $this->category,
            ]);
            if($manger){
                $this->dispatchBrowserEvent('hide-modal');
                $this->resetInputs();
                $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'تم تحديث بيانات المدير بنجاح']);
                $data =[
                    'title' => "تم تحديث بياناتك من قبل المسؤول",
                    'url' => url('/setting'),
                ];
                $user->notify(new SendNotification($data));
            }else{
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'حدث خطأ أثناء تحديث بيانات المدير ، حاول مرة أخرى']);
            }
        }
    }catch(Exception $e){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => $e->getMessage()]);
    }
    }

    public function showConfirm($id){
        $this->manger_id=$id;
        $user = Manger::where('id',$this->manger_id)->first();
        $this->user_id = $user->user_id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }

    public function destroy(){
        $this->authorize('delete-manger', Manger::class);
         try{
             $user = User::findOrFail($this->user_id);
             $role = Roles_Users::where('user_id',$user->id)->first();
             $user = $user->delete();
             $role = $role->delete();
             if($user && $role){
              $manger = Manger::findOrFail($this->manger_id);
              $manger = $manger->delete();
              $this->dispatchBrowserEvent('deleted-success');
            }else{
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'حدث خطأ أثناء حذف بيانات المدير ، حاول مرة أخرى']);
            }
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
        $this->category = '';
        $this->password = '';
    }
}
