<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public $name , $category_id;
    protected $rules=[
        'name' => 'required'
    ];
    protected $messages=[
      'name.required' => 'هذا الحقل مطلوب*'
    ];
    protected $listeners = [
        'delete' => 'destroy'
    ];

    public function render()
    {
        $categories = Category::get();
        return view('livewire.admin.category.categories',['categories'=>$categories])
        ->extends('Admin.layouts.master')
        ->section('content');
    }

    public function store(){
        $this->validate($this->rules);
        try{
        $category = Category::create(
            [
                'name' => $this->name
            ]
        );
        if($category){
            $this->dispatchBrowserEvent('hide-modal');
            $this->resetInputs();
            $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'تم إضافة تصنيف جديد بنجاح']);
        }else{
            $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => 'حدث خطأ عند الإضافة ، تأكد من البيانات المُدخلة']);
        }
    }catch(Exception $e){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => $e->getMessage()]);
    }
    }

    public function edit($id){
        $category = Category::where('id',$id)->first();
        $this->name = $category->name;
        $this->category_id = $id;
        $this->dispatchBrowserEvent('show-edit-category');
    }
    public function update(){
        $this->validate($this->rules);
        try{
            $category = Category::where('id',$this->category_id)->update(
                [
                    'name' => $this->name
                ]
                );
                if($category){
                    $this->dispatchBrowserEvent('hide-modal');
                    $this->resetInputs();
                    $this->dispatchBrowserEvent('alert',
                    ['type' => 'success',  'message' => 'تم تعديل التصنيف بنجاح']);
                }else{
                    $this->resetInputs();
                    $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'خطأ عند تعديل اسم التصنيف']);
                }
        }catch(Exception $e){
            $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => $e->getMessage()]);
        }
    }

    public function showConfirm($id){
        $category = Category::where('id',$id)->first();
        $this->category_id=$id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }
    public function destroy(){
        try{
            $category = Category::findOrFail($this->category_id);
            $category = $category->delete();
            if($category){
             $this->dispatchBrowserEvent('deleted-success');
           }else{
               $this->dispatchBrowserEvent('alert',
                   ['type' => 'error',  'message' => 'حدث خطأ أثناء حذف بيانات التصنيف ، حاول مرة أخرى']);
           }
        }catch(Exception $e){
           $this->dispatchBrowserEvent('alert',
           ['type' => 'error',  'message' => $e->getMessage()]);
       }
    }
    public function resetInputs(){
        $this->name = '';
    }
}
