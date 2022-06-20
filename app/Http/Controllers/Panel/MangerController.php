<?php

namespace App\Http\Controllers\Panel;

use Exception;
use App\Models\User;
use App\Models\Manger;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MangerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $mangers = Manger::get();

        return view('Admin.manger' , compact('categories' , 'mangers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required' , 'uniqe:users'],
            'phone' => ['required'],
            'category_id' => ['required'],
            'password' => ['required'],
        ])->validate();
        if($validate){
            try{
               $user = User::create([
                   'name' => $request->name,
                   'email' => $request->email,
                   'phone' => $request->phone,
                   'password' => Hash::make($request->password),
               ]);
               if($user){
                  $manger = Manger::create([
                    'category_id' => $request->category,
                    'user_id' => $user->id
                  ]);
                  if(! $manger){
                     User::findOrFail($user->id)->delete();
                  }else{
                    return redirect()->back()->with('success',' ! تم انشاء مدير جديد بنجاح');
                  }
               }
               return redirect()->back()->with('error',' خطأ ، لم يتم انشاء مدير جديد بنجاح');
            }catch(Exception $e){
                return redirect()->back()->with('error',$e->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required' , 'uniqe:users'],
            'phone' => ['required'],
            'category_id' => ['required'],
            'password' => ['required'],
        ])->validate();
        if($validate){
            try{
               $user = User::where('id',$request->user_id)->update([
                   'name' => $request->name,
                   'email' => $request->email,
                   'phone' => $request->phone,
                   'password' => Hash::make($request->password),
               ]);
               if($user){
                  $manger = Manger::where('id',$id)->update([
                    'category_id' => $request->category,
                  ]);
                  if($manger){
                    return redirect()->back()->with('success',' ! تم تعديل بيانات المدير  بنجاح');
                  }
               }
               return redirect()->back()->with('error',' خطأ ، لم يتم تعديل بيانات المدير بنجاح');
            }catch(Exception $e){
                return redirect()->back()->with('error',$e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manger = Manger::findOrFail($id);
        if($manger){
            $manger->delete();
            return redirect()->back()->with('success','تم حذف المدير بنجاح');
        }
        return redirect()->back()->with('error','هناك خطأ ، لم يتم الحذف');
    }
}
