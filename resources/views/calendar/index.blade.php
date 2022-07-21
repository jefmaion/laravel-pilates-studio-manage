@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Agenda" icon="fa fa-calendar" breadcrumb >
        <x-package-breadcrumb-item label="Planos" href="{{ route('plan.index') }}" />
        <x-package-breadcrumb-item label="Listagem de Planos" />
    </x-package-pageheader>
@stop

@section('content')

<x-adminlte-card theme="purple" theme-mode="outline">
<div class="row">
    <div class="col-12">

        <div class="row mb-2">
            <div class="col-6">
                <h1 id="calendar-month-title"></h1>
            </div>
            <div class="col-6 text-right">
                <div class="btn-group " role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary" onClick="changeTo('dayGridMonth')">Mês</button>
                    <button type="button" class="btn btn-secondary" onClick="changeTo('timeGridWeek')">Semana</button>
                    <button type="button" class="btn btn-secondary" onClick="changeTo('listWeek')">Lista </button>
                  </div>

                  <button type="button" class="btn btn-primary" onclick="today()">Hoje</button>

                  <button type="button" class="btn btn-primary" onclick="previousPeriod()">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </button>

                  <button type="button" class="btn btn-primary" onclick="nextPeriod()">
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                  </button>
            </div>
        </div>



    </div>
    <div class="col-12">
        <div id="fcalendar"></div>
    </div>
</div>

</x-adminlte-card>
   
@stop


@section('plugins.FullCalendar', true)

@section('js')
<script>

var SITEURL = "{{ url('/') }}";
  
  $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


        // Test Fullcalendar

        var calendarEl = document.getElementById('fcalendar')

        var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'pt-br',
                initialView: 'timeGridWeek',
                headerToolbar: false,
                slotMinTime:'07:00:00',
                slotMaxTime:'21:00:00',
                height: "auto",
                hiddenDays: [ 0 ],
                allDaySlot: false,
                // events: "{{ route('event.index') }}",
                eventSources: [

                    // your event source
                    {
                    url: '{{ route('event.index') }}',
                    method: 'GET',
                    
                    }

                    // any other sources...

                ]
        });

        calendar.render();
        setPeriodName()
        getEvents();


        function changeTo(value) {
            calendar.changeView(value)
            setPeriodName()
        }

        function today() {
            calendar.today();
            setPeriodName()
        }

        function nextPeriod() {
            calendar.next();
            setPeriodName()
        }

        function previousPeriod() {
            calendar.prev();
            setPeriodName()
        }

        function setPeriodName() {
            $('#calendar-month-title').html(calendar.view.title)
        }

        function getEvents() {

            // alert(calendar.startParam);
            // $.ajax({
            //     type: "POST",
            //     url: "{{ route('event.index') }}",
            //     data: {
            //         start: calendar.view.start,
            //         end: calendar.view.end
            //     },
            //     // dataType: "dataType",
            //     success: function (response) {
            //         console.log(response)
            //     }
            // });
        }

</script>
@endsection