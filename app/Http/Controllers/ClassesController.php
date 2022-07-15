<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Services\ClassesService;
use App\Services\InstructorService;
use App\Services\StudentService;
use App\Services\WeekService;

class ClassesController extends Controller
{

    protected $studentService;
    protected $classService;
    protected $instructorService;
    protected $weekService;


    public function __construct(
        StudentService $studentService, 
        ClassesService $classService, 
        InstructorService $instructorService,
        WeekService $weekService
    ) {
        $this->studentService = $studentService;
        $this->classService = $classService;
        $this->instructorService = $instructorService;
        $this->weekService = $weekService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($studentId)
    {
        $student = $this->studentService->find($studentId);

        return view('classes.index', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($studentId)
    {
        $student = $this->studentService->find($studentId);

        $instructors = $this->instructorService->listAll();
        $weeks = $this->weekService->list();

        


        return view('classes.create', compact('student', 'instructors', 'weeks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassesRequest $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassesRequest  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassesRequest $request, Classes $classes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $classes)
    {
        //
    }
}
