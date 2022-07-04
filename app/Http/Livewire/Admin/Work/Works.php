<?php

namespace App\Http\Livewire\Admin\Work;

use App\Models\User;
use App\Models\Work;
use App\Models\Manger;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Works extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use AuthorizesRequests;

    use WithFileUploads;
    public $title , $desc , $file , $category , $work_id , $work , $newFile
    , $oldFile , $reason , $filterType='all' , $filterCategory='all' , $selectWorks=[] ;
    protected $works;

    protected $rules = [
        'title' => 'required|unique:works',
        'desc' => 'required',
        'file' => 'required',
        'category' => 'required',
    ];
    protected $messages = [
        'title.required' => '* العنوان مطلوب',
        'desc.required' => '* الوصف مطلوب',
        'title.unique' => '* هذا العنوان يمتلك عمل',
        'file.required' => '* الملف مطلوب',
        'category.required' => '* التصنيف مطلوب',
    ];
    protected $listeners = [
        'delete' => 'destroy'
    ];

    public function render()
    {
        $this->authorize('view-work', Work::class);
        $categories = Category::get();

        return view('Admin.works',[
        'works' => $this->filter(),
        'categories'=>$categories])
        ->extends('Admin.layouts.master')
        ->section('content');
    }

        //  status 0 work new dont have approve
        //  status 1 work new have approve from admin
        //  status 2 work is approved
        //  status 3 work is reject
    public function store()
    {
        $this->authorize('create-work', Work::class);

        $this->validate($this->rules);
        try{
            // upload file
        $new_name = $this->file->store('public/uploades');

        $work = new Work();
            $work->title =  $this->title;
            $work->slug = Str::slug($this->title);
            $work->desc =  $this->desc;
            $work->file =  $new_name;
            $work->category_id =  $this->category;
            $work->user_id =  Auth::user()->id;
            if(Auth::user()->user_type == 'employee'){
                $work->status = 1;
            }else{
                $work->status = 0;
            }
        $work = $work->save();
            if($work){
                $this->dispatchBrowserEvent('hide-modal');
                $this->resetInputs();
                $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'تم إضافة عمل جديد بنجاح']);

                $data =[
                    'title' => "تم إضافة عمل جديد إلى الموقع",
                    'url' => "/works"
                ];
               $this->sendNotification($data);
            }else{
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'حدث خطأ أثناء إضافة عمل جديد ، حاول مرة أخرى']);
                User::where('id', $user->id)->delete();
            }
    }catch(Exception $e){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => $e->getMessage()]);
    }
    }

    public function edit($id){
        $this->work = Work::with('user')->with('category')->where('id', $id)->first();
        $this->title = $this->work ? $this->work->title : "";
        $this->desc = $this->work ? $this->work->desc : "";
        $this->oldFile = $this->work ? $this->work->file : "";
        $this->category = $this->work ? $this->work->category_id : "";
        $this->work_id = $id;

        $this->dispatchBrowserEvent('show-edit-work');
    }

    public function update(){
        $this->authorize('update-work', Work::class);

        $this->validate([
          'title' => ['required' , Rule::unique('works')->ignore($this->work_id)],
          'desc' => 'required',
          'category' => 'required',
        ]);
        try{

        //  status 0 work new dont have approve
        //  status 1 work new have approve from admin
        //  status 2 work is approved
        //  status 3 work is reject

            $work = Work::where('id',$this->work_id)->first();
            $work->title =  $this->title;
            $work->slug = Str::slug($this->title);
            $work->desc =  $this->desc;
            // upload file
            if($this->newFile != null){
                $new_name = $this->newFile->store('public/uploades');
                $work->file =  $new_name;
            }
            if($work->status == 3){
                $work->status = 1;
            }

            $work->category_id =  $this->category;
            $work = $work->save();
            if($work){
                $this->dispatchBrowserEvent('hide-modal');
                $this->resetInputs();
                $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'تم تعديل العمل بنجاح']);
            }else{
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'حدث خطأ أثناء تعديل العمل ، حاول مرة أخرى']);
                User::where('id', $user->id)->delete();
            }
    }catch(Exception $e){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => $e->getMessage()]);
    }
    }

    public function reasonReject($id){
       $this->work_id = $id;
       $this->dispatchBrowserEvent('show-reson-reject-work');
    }
    public function goToReject(){
       $this->changeStatus($this->work_id , 'rejected' , $this->reason);
    }

    public function changeStatus($id , $status , $reason=null){
        if($status == 'approved'){
            $work = Work::where('id',$id)->update(
                [
                  'status' => 2
                ]
                );
            if($work){
                $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'تم الموافقة على نشر العمل بنجاح']);
                $employee = User::where('id', Work::where('id',$id)->first()->user_id)->first();
                $data =[
                    'title' => "تم الموافقة على عملك",
                    'url' => '/works'
                ];
                $employee->notify(new sendNotification($data));
             }
        }else{
            $work = Work::where('id',$id)->update(
                [
                  'status' => 3,
                  'reject_reason' => $reason
                ]
                );
            if($work){
                $this->dispatchBrowserEvent('alert',
                ['type' => 'warning',  'message' => 'تم رفض  نشر العمل ']);
                $this->dispatchBrowserEvent('hide-modal');
                $employee = User::where('id', Work::where('id',$id)->first()->user_id)->first();
                $data =[
                    'title' => "تم رفض نشر عملك من قبل المسؤول",
                    'url' => '/works'
                ];
                $employee->notify(new sendNotification($data));
             }
        }
    }

    public function showConfirm($id){
        $this->work_id=$id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }

    public function destroy(){
        $this->authorize('delete-work', Work::class);

         try{
             $work = Work::findOrFail($this->work_id);
             $this->category = $work->category_id;
             $work = $work->delete();
             if($work){
              $this->dispatchBrowserEvent('deleted-success');
              $data =[
                'title' => "تم حذف عمل من الموقع",
                'url' => "/works"
            ];
            $this->sendNotification($data);
            }else{
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => 'حدث خطأ أثناء حذف بيانات العمل ، حاول مرة أخرى']);
            }
         }catch(Exception $e){
            $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => $e->getMessage()]);
        }
    }

    public function filter(){
        $work = Work::with('user')->with('category')->orderBy('id','desc');
        $manger = Manger::where('user_id',Auth::user()->id)->first();
        if($this->filterCategory == "all" && $this->filterType == "all"){
            if(Auth::user()->user_type == 'admin'){
                $works = Work::with('user')->with('category')->orderBy('id','desc')->paginate(20);
            }elseif(Auth::user()->user_type == 'manger'){
                $works = $work->where('category_id', $manger->category_id)->paginate(20);
            }else{
                $works = $work->where('user_id', Auth::user()->id)->paginate(20);
            }
        }else{
            if($this->filterCategory != "all" && $this->filterType == "all"){
                    $works = $work->where('category_id',$this->filterCategory)->paginate(20);
            } elseif($this->filterCategory == "all" && $this->filterType != "all"){
                if(Auth::user()->user_type == 'admin'){
                   if($this->filterType == 2){
                    $works = $work->whereIn('status',[0,2])->paginate(20);
                   }else{
                    $works = $work->where('status',$this->filterType)->paginate(20);
                   }
                }elseif(Auth::user()->user_type == 'manger'){
                    if($this->filterType == 2){
                        $works = $work->whereIn('status',[0,2])->where('category_id', $manger->category_id)->paginate(20);
                       }else{
                        $works = $work->where('status',$this->filterType)->
                        where('category_id', $manger->category_id)->paginate(20);
                       }
                }else{
                    if($this->filterType == 2){
                        $works = $work->whereIn('status',[0,2])->where('user_id', Auth::user()->id)->paginate(20);
                       }else{
                        $works = $work->where('status',$this->filterType)->
                        where('user_id', Auth::user()->id)->paginate(20);
                       }
                }
            }else{
                    if($this->filterType == 2){
                     $works = $work->whereIn('status',[0,2])->where('category_id',$this->filterCategory)->paginate(20);
                    }else{
                     $works = $work->where('status',$this->filterType)->where('category_id',$this->filterCategory)->paginate(20);
                    }
            }
        }
        $is_main=Work::where('is_main',1)->select('id')->get(6);
        foreach($is_main as $key=>$i){
            $this->selectWorks[$key] = $i->id;
        }
        return $works;

    }

    public function addToMainList($id){
        if(count($this->selectWorks) > 6){
            $this->dispatchBrowserEvent('remove_selected',['id'=> $id]);
            $this->dispatchBrowserEvent('show-worning-number-work');
        }else{
            $work = Work::where('id',$id)->first();
            if($work->is_main == false){
                $work->is_main = true;
            }else{
                $work->is_main = false;
            }
            $work->save();
        }
    }

    public function resetInputs()
    {
        $this->title = '';
        $this->desc = '';
        $this->file = '';
        $this->category = '';
    }

    public function sendNotification($data){
            $user = User::where('user_type' , 'admin')->first();
            $m = Manger::where('category_id',$this->category)->first();
            $user->notify(new SendNotification($data));
            if($m != null){
                $manger = User::where('id' , $m->user_id)->first();
                $manger->notify(new SendNotification($data));
            }
    }
}
