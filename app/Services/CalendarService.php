<?php

namespace App\Services;


class CalendarService extends BaseService {

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


            if($event->status == ClassEnum::Status_Executed) {
                $bg = 'bg-olive';
            }

            if($event->status == ClassEnum::Status_AbsensedJustified) {
                $bg = 'bg-orange';
            }

            if($event->status == ClassEnum::Status_Absensed) {
                $bg = 'bg-danger';
            }

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