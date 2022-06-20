<?php

namespace App\Http\Controllers\Panel;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreContentRequest;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = Content::first();
        return view('livewire.content',compact('content'));
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
     * @param  \App\Http\Requests\StoreContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContentRequest  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $reqex = '<p><br></p>';
        $validate = Validator::make($request->all(), [
            'whatOffer' => ['required' , 'max:700','not_in:'.$reqex],
            'OurMessage' => ['required' , 'max:700','not_in:'.$reqex],
            'whoWe' => ['required' , 'max:700','not_in:'.$reqex],
            'mechanismWork' => ['required' , 'max:700','not_in:'.$reqex],
        ])->validate();
        if($validate){
            $content = Content::first()->update(
                [
                    'whatOffer' => $request->whatOffer,
                    'OurMessage' => $request->OurMessage,
                    'whoWe' => $request->whoWe,
                    'mechanismWork' => $request->mechanismWork,
                ]
            );
            return redirect()->route('admin.content')->with('success' , 'تم تعديل محتوى الموقع بنجاح');
        }else{
            return redirect()->route('admin.content')->withError($validate);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        //
    }
}
