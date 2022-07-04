<?php

namespace App\Http\Livewire\Admin\Request;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Manger;
use App\Models\Request;
use Livewire\Component;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Description;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendNotification;
use App\View\Components\NotificationMenu;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Requests extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    public $search , $request , $category , $employee , $status , $delivryTime , $desc_id,
    $description = [] , $oldDescription , $request_id , $newDescription, $filterType='all' , $filterCategory='all'  ;

    protected $listeners = [
        'delete' => 'deleteDescription'
    ];

    public function render()
    {
        $this->authorize('view-request', Request::class);

        // $requests = Request::with('user')->with('guset')->with('category')
        // ->with('employee')->with('desc')->orderBy('id','desc')->paginate(20);
        $categories = Category::get();
        return view('Admin.requests' , [
            'requests' => $this->filter(),
            'categories'=>$categories,
            'descriptions' => $this->description
        ])
        ->extends('Admin.layouts.master')
        ->section('content');
    }

    public function goToAssign($id)
    {
        $request = Request::findOrFail($id);
        $this->request = $request;
        $this->employee = $request->employee_id;
        $this->dispatchBrowserEvent('showHistory');
    }

    public function filter(){
        $request = Request::with('user')->with('guset')->with('category')->with('rate')
        ->with('employee')->with('desc')->orderBy('id','desc');
        $manger = Manger::where('user_id',Auth::user()->id)->first();
        if($this->filterCategory == "all" && $this->filterType == "all"){
            if(Auth::user()->user_type == 'admin'){
                $requests = $request;
            }elseif(Auth::user()->user_type == 'manger'){
                $requests = $request->where('category_id', $manger->category_id);
            }else{
                $em = Employee::where('user_id',Auth::user()->id)->first();
                if($em != null){
                    $requests = $request->where('employee_id', $em->id);
                }else{
                    $requests = [];
                }

            }
        }else{
            if($this->filterCategory != "all" && $this->filterType == "all"){
                    $requests = $request->where('category_id',$this->filterCategory);
            } elseif($this->filterCategory == "all" && $this->filterType != "all"){
                if(Auth::user()->user_type == 'admin'){
                //    if($this->filterType == 2){
                //     $requests = $request->whereIn('status',[2,4,5])->paginate(20);
                //    }else{
                    $requests = $request->where('status',$this->filterType);
                //    }
                }elseif(Auth::user()->user_type == 'manger'){
                    // if($this->filterType == 2){
                    //     $requests = $request->whereIn('status',[2,4,5])->where('category_id', $manger->category_id)->paginate(20);
                    //    }else{
                        $requests = $request->where('status',$this->filterType)->
                        where('category_id', $manger->category_id);
                    //    }
                }else{
                    // if($this->filterType == 2){
                    //     $requests = $request->whereIn('status',[2,4,5])->where('user_id', Auth::user()->id)->paginate(20);
                    //    }else{
                        $em = Employee::where('user_id',Auth::user()->id)->first();
                        if($em != null){
                        $requests = $request->where('status',$this->filterType)->
                        where('employee_id', $em->id);
                        }else{
                            $requests = [];
                        }
                    //    }
                }
            }else{
                    // if($this->filterType == 2){
                    //  $requests = $request->whereIn('status',[2,4,5])->where('category_id',$this->filterCategory)->paginate(20);
                    // }else{
                     $requests = $request->where('status',$this->filterType)->where('category_id',$this->filterCategory);
                    // }
            }
        }
        $requests = $requests->search(trim($this->search))->paginate(15);
        return $requests;

    }

    public function assign(){

        $this->authorize('update-request', Request::class);
        if($this->request->status == 0 || $this->request->status == 1 ||  $this->request->status == 3){
            $this->dispatchBrowserEvent('alert',
            ['type' => 'warning',  'message' => 'أنت لست موافق على العمل ، لا يمكن تعيين العمل قبل الموافقة عليه']);
        }else{
        $this->request->employee_id = $this->employee;
        $save = $this->request->save();
       if($save){
        $this->dispatchBrowserEvent('alert',
        ['type' => 'success',  'message' => 'تم تعيين الموظف للعمل على الطلب بنجاح']);
        $data =[
            'title' => "تم تعيينك على عمل جديد من قبل المسؤول",
            'url' => "/requests"
        ];
        $user = User::where('id' , Employee::where('id',$this->employee)->first()->user_id)->first();
        $user->notify(new SendNotification($data));
       }else{
        $this->dispatchBrowserEvent('alert',
        ['type' => 'error',  'message' => 'خطا عند تعيين الموظف للقيام بالعمل ، حاول مرة أخرى']);
       }
    }
        $this->assetResetInput();
        $this->dispatchBrowserEvent('hide-modal');
        }

    public function update($id){
        $request = Request::findOrFail($id);
        $this->request = $request;
        $this->status = $request->status;
        $this->request_id = $id;
        $this->description = $request->desc;
        $this->delivryTime = $request->delivery_time;
        $this->descriptions = Description::where('request_id',$this->request_id)->get();
        $this->dispatchBrowserEvent('controlWork');
    }
    public function edit(){

        $this->authorize('create-description', Description::class);
        if($this->oldDescription != null){
            $desc = Description::create([
                'request_id' => $this->request->id,
                'user_id' => Auth::user()->id,
                'text' => $this->oldDescription
            ]);
        }

        $this->request->status = $this->status;
        $this->request->delivery_time = $this->delivryTime;
        $save = $this->request->save();
        if($save){
            // $this->descriptions = Description::where('request_id',$this->request_id)->get();

            $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'تم تعديل حالة الطلب / إضافة وصف  بنجاح']);

            $data = [
                'title' => "تم اضافة ملاحظات / تغيير حالة العمل {{$this->request->project_name}}",
                'url' => '/requests'
            ];
            if($this->request->employee_id != null){
            $user = User::where('id' , Employee::where('id',$this->request->employee_id)->first()->user_id)->first();
            $user->notify(new SendNotification($data));
            }
            $manger = Manger::where('category_id',$this->request->category_id)->first();
            if($manger != null){
            $user_manger = User::where('id' , $manger->user_id)->first();
            $user_manger->notify(new SendNotification($data));
            }
            $admin = User::where('user_type','admin')->first();
            $admin->notify(new SendNotification($data));

           }else{
            $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => 'خطا عند تعديل حالة الطلب / إضافة وصف ، حاول مرة أخرى']);
        }
        $this->resetInput();
        $this->dispatchBrowserEvent('hide-modal');
    }

    public function editDesc($id){
        $desc = Description::findOrFail($id);
        $this->newDescription = $desc->text;
        $this->dispatchBrowserEvent('editDescription',['id' => $id]);
    }

    public function updateDesc($id){
        $this->authorize('update-description', Description::class);
        $desc = Description::findOrFail($id);
        $desc->text = $this->newDescription;
        $save = $desc->save();

        if($save){
            $this->descriptions = Description::where('request_id',$this->request_id)->get();
            $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'تم تعديل الوصف  بنجاح']);

           }else{
            $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => 'خطا عند تعديل الوصف ، حاول مرة أخرى']);
        }
        // $this->dispatchBrowserEvent('hide-modal');

    }

    public function getToDeleteDescription($id){
        $this->desc_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }
    public function deleteDescription(){
        $this->authorize('delete-description', Description::class);
        $desc = Description::findOrFail($this->desc_id);
        $delete = $desc->delete();
        if($delete){
            $this->descriptions = Description::where('request_id',$this->request_id)->get();
            $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'تم حذف الوصف  بنجاح']);
           }else{
            $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => 'خطا عند حذف الوصف ، حاول مرة أخرى']);
         }
    }

    public function resetInput(){
        $this->status = '';
        $this->delivryTime = '';
        $this->oldDescription = '';
    }
    public function assetResetInput()
    {
        $this->employee = '';
    }

}
