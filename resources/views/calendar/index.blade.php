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
                <button type="button" class="btn btn-primary">Agendar Aula</button>
            </div>
            <div class="col-4 text-center">
                <h1 id="calendar-month-title"></h1>
            </div>
            <div class="col-4 text-right">
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


<!-- Modal -->
<div class="modal fade" id="modal-event" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-purple">
                <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger">
                    <i class="fas fa-stop-circle    "></i>
                    Apontar Falta
                </button>

                <button type="button"  class="bg-purple btn">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    Finalizar Aula
                </button>
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
                eventSources: [

                    // your event source
                    {
                    url: '{{ route('event.index') }}',
                    method: 'GET',
                    
                    }

                    // any other sources...

                ],
                eventClick: function(info) {
                    showEvent(info.event.id)
                    // console.log(info)
                    // alert('Event: ' + info.event.title);
                    // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    // alert('View: ' + info.view.type);

                    // // change the border color just for fun
                    // info.el.style.borderColor = 'red';
                    
                }
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

        function showEvent(eventId) {

            $.ajax({
                type: "GET",
                url: "{{ route('event.show', '') }}/" + eventId,
              
                // dataType: "dataType",
                success: function (response) {

                    $('#modal-event .modal-body').html(response)
                    $('#modal-event').modal('show')
                    console.log(response)
                }
            });
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