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
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    protected $registrationService;
    protected $studentService;
    protected $planService;
    protected $instructorService;
    protected $paymentMethodService;
    protected $weekdayService;

    public function __construct(
        RegistrationService $registrationService, 
        StudentService $studentService, 
        PlanService $planService, 
        InstructorService $instructorService,
        PaymentMethodService $paymentMethodService,
        WeekService $weekdayService
    )
    {
        $this->registrationService = $registrationService;
        $this->studentService = $studentService;
        $this->planService = $planService;
        $this->instructorService = $instructorService;
        $this->paymentMethodService = $paymentMethodService;
        $this->weekdayService = $weekdayService;
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
        $students     = $this->studentService->listAll();
        $plans        = $this->planService->listAll();
        $paymentMethods  = $this->paymentMethodService->listAll();
        return view('registration.create', compact('registration' ,'students', 'plans',  'paymentMethods'));
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
        $instructors  = $this->instructorService->listAll();
        $paymentMethods  = $this->paymentMethodService->listAll();
        return view('registration.edit', compact('registration' ,'students', 'plans', 'instructors', 'paymentMethods'));

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

    public function week(Request $request) {
        $req = $request->except('_token');


        $index = $req['_index'];
        $time  = $req['class_time'];
        $instructor = $this->instructorService->find($req['instructor_id']);
        $weekday = $this->weekdayService->find($req['class_week']);
        
        return view('registration.row', compact('index', 'instructor', 'weekday', 'time'))->render();
    }
}
