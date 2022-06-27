<?php

namespace App\Http\Controllers;

use App\Models\Guset;
use App\Http\Requests\StoreGusetRequest;
use App\Http\Requests\UpdateGusetRequest;

class GusetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreGusetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGusetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guset  $guset
     * @return \Illuminate\Http\Response
     */
    public function show(Guset $guset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guset  $guset
     * @return \Illuminate\Http\Response
     */
    public function edit(Guset $guset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGusetRequest  $request
     * @param  \App\Models\Guset  $guset
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGusetRequest $request, Guset $guset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guset  $guset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guset $guset)
    {
        //
    }
}
