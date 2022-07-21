<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        

        $events = Classes::with(['student', 'instructor'])->whereDate('date', '>=', $request->start)
            ->whereDate('date', '<=', $request->end)
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



    private function prepareEvents($events) {

        $json = [];
        foreach($events as $event) {

            $bg = 'bg-purple disabled ';

            if($event->status == 'C') {
                $bg = 'bg-danger';
            }

            if($event->status == 'E') {
                $bg = 'bg-success';
            }


            $json[] = [
                'id' => $event->id,
                'start' => $event->date .'T'.$event->time,
                'end' => $event->date,
                'title' => $event->student->user->nickname . ' ',
                'className' => [$bg, 'border-0'],
                'event' => $event
            ];
        }

        return $json;
    }
}
