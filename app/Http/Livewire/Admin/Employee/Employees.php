<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Models\User;
use Livewire\Component;
use App\Models\Category;
use App\Models\Employee;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class Employees extends Component
{
    use WithPagination;
    public $employee;
    public $employee_id , $user_id;
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
        $categories = Category::get();
        $employees = Employee::with('user')->with('category')
       ->orderBy('id','desc')->paginate(20);

        return view('livewire.admin.employee.employees'
        , compact('categories' , 'employees'))
        ->extends('Admin.layouts.master')
        ->section('content');
    }

    public function store()
    {
        $this->validate($this->rules);
        try{
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'user_type' => 'employee'
        ]);
        if($user){
            try{
                $employee = Employee::create([
                    'user_id' => $user->id,
                    'category_id' => $this->category,
                ]);
            }catch(Exception $e){
                User::where('id', $user->id)->delete();
                $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => $e->getMessage()]);
            }
            if($employee){
                $this->dispatchBrowserEvent('hide-modal');
                $this->resetInputs();
                $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'تم إضافة موظف جديد بنجاح']);
            }else{
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'حدث خطأ أثناء إضافة موظف جديد ، حاول مرة أخرى']);
                User::where('id', $user->id)->delete();
            }
        }
    }catch(Exception $e){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => $e->getMessage()]);
    }
    }

    public function edit($id){
        $this->employee = Employee::with('user')->where('id', $id)->first();
        $this->name = $this->employee ? $this->employee->user->name : "";
        $this->email = $this->employee ? $this->employee->user->email : "";
        $this->phone = $this->employee ? $this->employee->user->phone : "";
        $this->category = $this->employee ? $this->employee->category_id : "";
        $this->password = null;
        $this->employee_id = $id;
        $user = Employee::where('id',$this->employee_id)->first();
        $this->user_id = $user->user_id;

        $this->dispatchBrowserEvent('show-edit-employee');
    }

    public function update(){
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
        $user = $user->save();
        if($user){
            $employee = Employee::where('id',$this->employee_id)->update([
                'category_id' => $this->category,
            ]);
            if($employee){
                $this->dispatchBrowserEvent('hide-modal');
                $this->resetInputs();
                $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'تم تحديث بيانات الموظف بنجاح']);
            }else{
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'حدث خطأ أثناء تحديث بيانات الموظف ، حاول مرة أخرى']);
            }
        }
    }catch(Exception $e){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => $e->getMessage()]);
    }
    }

    public function showConfirm($id){
        $this->employee_id=$id;
        $user = Employee::where('id',$this->employee_id)->first();
        $this->user_id = $user->user_id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }

    public function destroy(){
         try{
             $user = User::findOrFail($this->user_id);
             $user = $user->delete();
             if($user){
              $employee = Employee::findOrFail($this->employee_id);
              $employee = $employee->delete();
              $this->dispatchBrowserEvent('deleted-success');
            }else{
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'حدث خطأ أثناء حذف بيانات الموظف ، حاول مرة أخرى']);
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
