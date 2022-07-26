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
            <div class="col-4">

                <div class="form-group">
                  <select class="form-control" name="" id="instructor" onchange="refresh(this.value)">
                    <option value="">(Todos os Professores)</option>
                    @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->user->name }}</option>
                    @endforeach
                  </select>
                </div>
{{-- 
                <button type="button" class="btn bg-purple">Agendar Aula</button> --}}
            </div>
            <div class="col-4 text-center">
                <h1 id="calendar-month-title"></h1>
            </div>
            <div class="col-4 text-right">
                <div class="btn-group " role="group" aria-label="Basic example">
                    <button type="button" class="btn bg-purple" onClick="changeTo('dayGridMonth')">Mês</button>
                    <button type="button" class="btn bg-purple" onClick="changeTo('timeGridWeek')">Semana</button>
                    <button type="button" class="btn bg-purple" onClick="changeTo('listWeek')">Lista </button>
                  </div>

                  <button type="button" class="btn btn-primary" onclick="today()">Hoje</button>

                  <button type="button" class="btn bg-purple" onclick="previousPeriod()">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </button>

                  <button type="button" class="btn bg-purple" onclick="nextPeriod()">
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


<!-- Modal Resumo -->
<div id="modal-resumo"></div>
<!-- Modal Resumo -->

    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" data-bacskdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
    
                <div class="modal-body p-0">
                </div>
            </div>
        </div>    
    </div>


<x-adminlte-modal id="modal-evsent" v-centered theme="purple" icon="fas fa-bolt" size='lg' disable-animations>
   
    <h4>
        <i class="fa fa-user" aria-hidden="true"></i>
        Jefferson Silveira
    </h4>

     <div>
        <i class="fa fa-user" aria-hidden="true"></i>
        Joana Clauida
    </div>
    
</x-adminlte-modal>

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
                slotLabelFormat:{
                    hour: 'numeric',
                    minute: '2-digit',
                    omitZeroMinute: false,
                },
                eventSources: [{
                    url: '{{ route('event.index') }}',
                    method: 'GET',
                    extraParams: function () { // a function that returns an object
                                return {
                                    ei: $('#instructor').val()
                                }

                            },
                }],
                eventClick: function(info) {
                    showEvent(info.event.id)
                }  
        });


        calendar.render();
        setPeriodName()
        getEvents();

        function refresh(value) {
            calendar.refetchEvents()
        }


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

        function showEvent(eventId) {

            $.ajax({
                type: "GET",
                url: "{{ route('event.show', '') }}/" + eventId,
              
                // dataType: "dataType",
                success: function (response) {

                    setModal(response)
                    // $('#modal-event').modal('show')
                    $('#modal-default').modal('show')

                }
            });
        }

        function setPresence(eventId) {
            
            $.ajax({
                type: "GET",
                url: "event/" +eventId+ "/presence",
            
                // dataType: "dataType",
                success: function (response) {
                    setModal(response)
                    // $('#modal-event').modal('show')
                    $('#modal-default').modal('show')
                }
            });
        }

        function setAbsense(eventId) {
            
            $.ajax({
                type: "GET",
                url: "event/" +eventId+ "/absense",
            
                // dataType: "dataType",
                success: function (response) {
                    setModal(response)
                    // $('#modal-event').modal('show')
                    $('#modal-default').modal('show')
                }
            });
        }

        function rescheduleClass(eventId) {
            $.ajax({
                type: "GET",
                url: "event/" +eventId+ "/reschedule",
            
                // dataType: "dataType",
                success: function (response) {
                    setModal(response)
                    // $('#modal-event').modal('show')
                    $('#modal-default').modal('show')
                }
            });
        }

        function setModal(data) {
            //  $('#modal-resumo').html("").html(data)
            // $('body').append(data)

            $('#modal-default .modal-body').html("").html(data)
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