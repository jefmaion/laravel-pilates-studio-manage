<?php

namespace App\Http\Controllers;

use App\Services\PlanService;
use App\Services\RegistrationService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    protected $registrationService;
    protected $studentService;
    protected $planService;

    public function __construct(RegistrationService $registrationService, StudentService $studentService, PlanService $planService)
    {
        $this->registrationService = $registrationService;
        $this->studentService = $studentService;
        $this->planService = $planService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrations = $this->registrationService->listAll();
        return view('registration.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registration = $this->registrationService->new();
        $students = $this->studentService->listAll();
        $plans = $this->planService->listAll();
        return view('registration.create', compact('registration' ,'students', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->registrationService->createRegistration($request->except('token'));
        return redirect()->route('registration.index');
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
        $registration = $this->registrationService->find($id);
        $students = $this->studentService->listAll();
        $plans = $this->planService->listAll();
        return view('registration.edit', compact('students', 'plans','registration'));

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
        $this->registrationService->updateRegistration($request->except(['_method', '_token']), $id);
        return redirect()->route('registration.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->registrationService->delete($id);
        return redirect()->route('registration.index');
    }
}
