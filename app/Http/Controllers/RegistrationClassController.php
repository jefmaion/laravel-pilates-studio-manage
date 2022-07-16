<?php

namespace App\Http\Controllers;

use App\Services\InstructorService;
use App\Services\RegistrationService;
use App\Services\StudentService;
use App\Services\WeekService;
use Illuminate\Http\Request;

class RegistrationClassController extends Controller
{


    protected $registrationService;
    protected $instructorService;
    protected $studentService;
    protected $weekService;


    public function __construct(
        RegistrationService $registrationService,
        StudentService $studentService, 
        InstructorService $instructorService,
        WeekService $weekService
    )
    {
        $this->registrationService = $registrationService;
        $this->studentService = $studentService;
        $this->instructorService = $instructorService;
        $this->weekService = $weekService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($registrationId)
    {


        $registration = $this->registrationService->find($registrationId);
        $classes = $registration->classes;


        return view('registration_class.index', compact('registration', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($registrationId)
    {
        $registration = $this->registrationService->find($registrationId);
        $instructors = $this->instructorService->listInstructors();
        $weeks = $this->weekService->list();

        return view('registration_class.create', compact('registration', 'instructors', 'weeks'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $registrationId)
    {

        $registration = $this->registrationService->find($registrationId);

        $this->registrationService->generateRegistrationClasses($registration, $request->except(['_token']));

        return redirect()->route('registration.class.index', $registration);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
