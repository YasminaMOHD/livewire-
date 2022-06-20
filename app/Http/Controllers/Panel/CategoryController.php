<?php

namespace App\Http\Controllers\Panel;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.category', compact('categories'));
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required'],
        ])->validate();
        if($validate){
            $category = Category::create([
                'name' => $request->name,
            ]);
            if($category){
                return redirect()->back()->with('success',' ! تم إضافة التصميف بنجاح');
            }
            return redirect()->back()->with('error',' ! هُناك خطأ ، لم تتم إضافة التصنيف ');
        }else{
            return redirect()->back()->withError($validate);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required'],
        ])->validate();
        if($validate){
            $category = Category::where('id',$id)->update([
                'name' => $request->name,
            ]);
            if($category){
                return redirect()->back()->with('success',' ! تم تعديل التصميف بنجاح');
            }
            return redirect()->back()->with('error',' ! هُناك خطأ ، لم تتم تعديل التصنيف ');
        }else{
            return redirect()->back()->withError($validate);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category != null){
            $category->delete();
            return redirect()->back()->with('success' , 'تم الحذف بنجاح');
        }
         return redirect()->back()->with('error' , '! هُناك خطأ ، تأكد من العنصر الذي تريد حذفه');
    }
}
