<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\PaymentMethod;
use App\Services\InstructorService;
use App\Services\PaymentMethodService;
use App\Services\PlanService;
use App\Services\RegistrationService;
use App\Services\StudentService;
use App\Services\WeekService;
use Carbon\Carbon;
use Illuminate\Http\Request;


class RegistrationController extends Controller
{

    protected $registrationService;
    protected $studentService;
    protected $instructortService;
    protected $planService;
    protected $paymentMethodService;
    protected $weekdayService;

    public function __construct(
        RegistrationService $registrationService, 
        StudentService $studentService, 
        PlanService $planService, 
        PaymentMethodService $paymentMethodService,
        WeekService $weekdayService,
        InstructorService $instructorService
    ) {
        $this->registrationService = $registrationService;
        $this->studentService = $studentService;
        $this->planService = $planService;
        $this->paymentMethodService = $paymentMethodService;
        $this->weekdayService = $weekdayService;
        $this->instructorService = $instructorService;

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
        $registration    = $this->registrationService->new();
        $students        = $this->studentService->listAll();
        $plans           = $this->planService->listAll();
        $paymentMethods  = $this->paymentMethodService->listAll();

        $instructors = $this->instructorService->listInstructors();
        $weeks = $this->weekdayService->list();

        return view('registration.create', compact('registration' ,'students', 'plans',  'paymentMethods', 'instructors', 'weeks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrationRequest $request)
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
        $registration = $this->registrationService->find($id);
        return view('registration.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registration    = $this->registrationService->find($id);
        $students        = $this->studentService->listAll();
        $plans           = $this->planService->listAll();
        $paymentMethods  = $this->paymentMethodService->listAll();
        $weeks = $this->weekdayService->list();
        $instructors = $this->instructorService->listInstructors();
        return view('registration.edit', compact('registration' ,'students', 'plans',  'paymentMethods', 'weeks', 'instructors'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegistrationRequest $request, $id)
    {


        $registration = $this->registrationService->find($id);

        $this->registrationService->updateRegistration($registration, $request->except(['_method', '_token']));
        return redirect()->route('registration.index');
    }

    public function cancel(Request $request, $id) {
        $this->registrationService->cancelRegistration($request->except(['_method', '_token']), $id);
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
