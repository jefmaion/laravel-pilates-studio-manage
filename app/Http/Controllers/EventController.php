<?php

namespace App\Http\Controllers;

use App\Enums\ClassEnum;
use App\Http\Requests\EventUpdateRequest;
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
        
        $events = Classes::with(['student', 'instructor'])
                    ->whereDate('date', '>=', $request->start)
                    ->whereDate('date', '<=', $request->end)
                    ->when($request->instructor_id, function($query) use($request)  {
                        $query->where('instructor_id', $request->instructor_id);
                    })
                    ->when($request->student_id, function($query) use($request)  {
                        $query->where('student_id', $request->student_id);
                    })
                    ->when($request->status, function($query) use($request)  {
                        $query->where('status', $request->status);
                    })
                    ->get();


  

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
    public function update(EventUpdateRequest $request, $id)
    {
        
        $class = $this->classService->find($id);
        $data = $request->except(['_method', '_token']);

        $this->classService->setPresence($class, $data);

        // return redirect()->route('calendar.index');

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

        
            $typeClass = '<span class="badge badge-pill bg-warning text-white mx-1">'.$event->class_type.'</span>';

            if($event->class_type == ClassEnum::Type_NormalClass) {
                $typeClass = " ";
            }

 
            if($event->status) {

                $bg = 'bg-' . ClassEnum::Status[$event->status]['color'];
            }



            $json[] = [
                'id'        => $event->id,
                'start'     => $event->date .'T'.$event->time,
                'end'       => $event->date,
                'title'     => $event->student->user->nickname,
                'time' => substr($event->time,0,5),
                'className' => [$bg, 'border-0'],
                'html' => '<span>'.
                                $typeClass.
                                '<b>'.substr($event->time,0,5).'</b> ' .
                                $event->student->user->nickname. 
                            '</span>'
                
            ];
        }

        return $json;
    }
}
