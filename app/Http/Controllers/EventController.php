<?php

namespace App\Http\Controllers;

use App\Enums\ClassEnum;
use App\Models\Classes;
use App\Services\ClassesService;
use App\Services\InstructorService;
use Illuminate\Http\Request;

class EventController extends Controller
{

    protected $classService;
    protected $instructorService;

    public function __construct(ClassesService $classService, InstructorService $instructorService)
    {
        $this->classService      = $classService;
        $this->instructorService = $instructorService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $events = Classes::with(['student', 'instructor'])->whereDate('date', '>=', $request->start)->whereDate('date', '<=', $request->end)->when(
            $request->ei, function($query) use($request)  {
                $query->where('instructor_id', $request->ei);
            })->get();


  

            $events = $this->prepareEvents($events);

            return response()->json($events);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = $this->classService->find($id);
        return view('event.resume',  compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->classService->find($id);
        $instructors = $this->instructorService->listAll();
        $status = ClassEnum::Status_Executed;
        return view('event.presence',  compact('event', 'instructors', 'status'));
    }

    public function presence($id)
    {
        $event = $this->classService->find($id);
        $instructors = $this->instructorService->listAll();
        $status = ClassEnum::Status_Executed;
        return view('event.presence',  compact('event', 'instructors', 'status'));
    }

    public function absense($id)
    {
        $event = $this->classService->find($id);
        $instructors = $this->instructorService->listAll();
        $status = ClassEnum::Status_Executed;
        return view('event.absense',  compact('event', 'instructors', 'status'));
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
        
        $class = $this->classService->find($id);
        $data = $request->except(['_method', '_token']);

        $this->classService->setPresence($class, $data);

        return redirect()->route('calendar.index');

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

    public function reschedule($id)
    {
        $event = $this->classService->find($id);
        $instructors = $this->instructorService->listAll();
        return view('event.reschedule',  compact('event', 'instructors'));
    }

    public function rescheduleStore(Request $request, $id)
    {
       
        $class = $this->classService->find($id);
        $data = $request->except(['_token']);


        $this->classService->reschedule($class, $data);

        return redirect()->route('calendar.index');
    }


    private function prepareEvents($events) {

        $json = [];
        foreach($events as $event) {

            $bg = '';

            if($event->class_type == ClassEnum::Type_RepositionClass) {
                $bg = 'bg-purple';
            }

            if($event->class_type == ClassEnum::Type_FreeClass) {
                $bg = 'bg-info';
            }


            if($event->class_type == ClassEnum::Type_ExperimentalClass) {
                $bg = 'bg-outline-warning';
            }


            // if($event->status == ClassEnum::Status_Executed) {
            //     $bg = 'bg-olive';
            // }

            // if($event->status == ClassEnum::Status_AbsensedJustified) {
            //     $bg = 'bg-orange';
            // }

            // if($event->status == ClassEnum::Status_Absensed) {
            //     $bg = 'bg-danger';
            // }

            // if($event->status == ClassEnum::Status_Executed) {
            //     $bg = 'bg-success';
            // }

            // if($event->status == 'E') {
            //     $bg = 'bg-success';
            // }


            $json[] = [
                'id'        => $event->id,
                'start'     => $event->date .'T'.$event->time,
                'end'       => $event->date,
                'title'     => $event->student->user->name,
                'className' => [$bg, 'border-0'],
                'icon' => '<span class="badge badge-pill badge-secondary">'.$event->class_type.'</span>'
                
            ];
        }

        return $json;
    }
}
