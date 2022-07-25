<?php

namespace App\Http\Controllers;

use App\Models\ClassStatus;
use App\Http\Requests\StoreClassStatusRequest;
use App\Http\Requests\UpdateClassStatusRequest;

class ClassStatusController extends Controller
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
     * @param  \App\Http\Requests\StoreClassStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassStatus  $classStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ClassStatus $classStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassStatus  $classStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassStatus $classStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassStatusRequest  $request
     * @param  \App\Models\ClassStatus  $classStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassStatusRequest $request, ClassStatus $classStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassStatus  $classStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassStatus $classStatus)
    {
        //
    }
}
