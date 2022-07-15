<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\PaymentMethod;
use App\Services\PaymentMethodService;
use App\Services\PlanService;
use App\Services\RegistrationService;
use App\Services\StudentService;
use App\Services\WeekService;
use Illuminate\Http\Request;


class RegistrationController extends Controller
{

    protected $registrationService;
    protected $studentService;
    protected $planService;
    protected $paymentMethodService;
    protected $weekdayService;

    public function __construct(
        RegistrationService $registrationService, 
        StudentService $studentService, 
        PlanService $planService, 
        PaymentMethodService $paymentMethodService,
        WeekService $weekdayService
    ) {
        $this->registrationService = $registrationService;
        $this->studentService = $studentService;
        $this->planService = $planService;
        $this->paymentMethodService = $paymentMethodService;
        $this->weekdayService = $weekdayService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($studentId)
    {

        $student = $this->studentService->find($studentId);
        $registration = $student->registration;

        // $registrations = $this->registrationService->listAll();
        return view('registration.index', compact('student', 'registration'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($studentId)
    {
        $registration    = $this->registrationService->new();
        $student       = $this->studentService->find($studentId);
        $plans           = $this->planService->listAll();
        $paymentMethods  = $this->paymentMethodService->listAll();
        return view('registration.create', compact('registration' ,'student', 'plans',  'paymentMethods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($studentId, RegistrationRequest $request)
    {
        $student = $this->studentService->find($studentId);
        $this->registrationService->createRegistration($student, $request->except('token'));
        return redirect()->route('student.registration.index', $student);
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
    public function edit($studentId, $registrationId)
    {
        $registration    = $this->registrationService->find($registrationId);
        $student         = $registration->student;
        $plans           = $this->planService->listAll();
        $paymentMethods  = $this->paymentMethodService->listAll();
        return view('registration.edit', compact('registration' ,'student', 'plans',  'paymentMethods'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($studentId, $registrationId, RegistrationRequest $request)
    {

        $registration = $this->registrationService->find($registrationId);

        $this->registrationService->updateRegistration($registration, $request->except(['_method', '_token']));
        return redirect()->route('student.registration.index', $registration->student);
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
    public function destroy($studentId, $registrationId)
    {
        $student = $this->studentService->find($studentId);
        $this->registrationService->delete($student->registration->id);
        return redirect()->route('student.registration.index', $student);
    }

}
