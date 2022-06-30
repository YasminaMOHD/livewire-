<?php

namespace App\Http\Livewire\Admin\Authority;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Authorities extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use AuthorizesRequests;

    public $permission=[] , $name  , $permissions=[] , $role_id , $checkAll=false;

    protected $rules =[
        'name' => 'required|unique:roles,name'
    ];
    protected $messages = [
        'name.required' => 'هذا الحقل مطلوب *',
        'name.unique' => 'هذا الحقل يمتلك صلاحيات مُسبقا *'
    ];
    protected $listeners = [
        'delete' => 'destroy'
    ];

    public function render()
    {
        $roles = Role::get();

        return view('admin.authorities' , [
            'roles' => $roles,
        ])
        ->extends('admin.layouts.master')->section('content');
    }


    public function selectAll(){
        $this->checkAll = ! $this->checkAll;
        $this->permissions = $this->checkAll ? array_keys(config('permission')) : [];

        $this->dispatchBrowserEvent('checkAll',
        ['checkAll' => $this->checkAll]);
    }

    public function store(){
        $this->validate($this->rules);
        try{

        $role = Role::create([
            'name' => $this->name,
            'permissions' => $this->permissions,
        ]);

        if($role){
            $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'تم إضافة صلاحيات للمستخدم بنجاح']);
        }else{
            $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => 'حدث خطأ أثناء إضافة صلاحيات للمستخد ، حاول مرة أخرى']);
        }

    }catch(Exception $e){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => $e->getMessage()]);
    }


    }

    public function update($id){
        $role = Role::findOrFail($id);
        $this->role_id = $id;
        $this->name = $role->name;
        $this->permissions = $role->permissions;
        $this->dispatchBrowserEvent('show-edit-work');
    }
    public function edit(){
        $this->validate(
            [
                'name' => [
                    'required',
                    'unique:roles,name,'.$this->role_id,
                    Rule::unique('roles')->ignore($this->role_id),
                ],
                'permissions' => 'required',
            ]
        );
        try{
            $role = Role::where('id',$this->role_id)->update([
                'name' => $this->name,
                'permissions' => $this->permissions,
            ]);

            if($role){
                $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'تم تعدديل صلاحيات للمستخدم بنجاح']);
            }else{
                $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => 'حدث خطأ أثناء تعديل صلاحيات للمستخدم ، حاول مرة أخرى']);
            }

        }catch(Exception $e){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => $e->getMessage()]);
    }
    }

    public function showConfirm($id){
        $this->role_id=$id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }
    public function destroy(){
        $role = Role::findOrFail($this->role_id);
        $role = $role->delete();

        if($role){
            $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'تم حذف صلاحيات للمستخدم بنجاح']);
        }else{
            $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => 'حدث خطأ أثناء حذف صلاحيات للمستخدم ، حاول مرة أخرى']);
        }
    }
}
