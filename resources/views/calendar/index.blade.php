@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Agenda" icon="fa fa-calendar" breadcrumb >
        <x-package-breadcrumb-item label="Planos" href="{{ route('plan.index') }}" />
        <x-package-breadcrumb-item label="Listagem de Planos" />
    </x-package-pageheader>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('content')


<x-adminlte-card theme="purple" theme-mode="outline">
<div class="row">
    <div class="col-12">
        
        

        <div class="row mb-2">

            <div class="col-4 text-left">
                <h1 id="calendar-month-title"></h1>
            </div>
            <div class="col">

                <div class="form-group">
                  <select class="form-control select2" name="" id="instructor" onchange="refresh(this.value)">
                    <option value="">(Todos os Professores)</option>
                    @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->user->name }}</option>
                    @endforeach
                  </select>
                </div>

                
{{-- 
                <button type="button" class="btn bg-purple">Agendar Aula</button> --}}
            </div>
            <div class="col">
                <div class="form-group">
                    <select class="form-control select2" name="" id="student" onchange="refresh(this.value)">
                      <option value="">(Todos os Alunos)</option>
                      @foreach($registrations as $registration)
                      <option value="{{ $registration->student->id }}">{{ $registration->student->user->name }}</option>
                      @endforeach
                    </select>
                  </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <select class="form-control select2" name="" id="status" onchange="refresh(this.value)">
                      <option value="">(Todos)</option>
                      @foreach($statuses as $key => $status)
                      <option value="{{ $key }}">{{ $status['label'] }}</option>
                      @endforeach
                    </select>
                  </div>
            </div>
           
            <div class="col-4 text-right">
                
                <button type="button" class="btn btn-primary" onclick="today()">Hoje</button>
                <div class="btn-group " role="group" aria-label="Basic example">
                    <button type="button" class="btn bg-purple" onClick="changeTo('dayGridMonth')">Mês</button>
                    <button type="button" class="btn bg-purple" onClick="changeTo('timeGridWeek')">Semana</button>
                    {{-- <button type="button" class="btn bg-purple" onClick="changeTo('listWeek')">Lista </button> --}}
                  </div>

                  

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

<div id="modal-container"></div>

</x-adminlte-card>

@stop


@section('plugins.FullCalendar', true)
@section('plugins.Select2', true)


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
                nowIndicator:true,
                height: "auto",
                eventMinHeight:20,
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
                            instructor_id: $('#instructor').val(),
                            student_id: $('#student').val(),
                            status: $('#status').val(),
                        }

                    },
                }],
                eventClick: function(info) {
                    showEvent(info.event.id)
                } ,
                eventContent: function(arg) {
                    event = arg.event
                    data = arg.event.extendedProps
                    return {
                        html: data.html
                    } 
                }
        });


        calendar.render();
        setPeriodName()


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
                success: function (response) {
                    showModal('modal-event', response);
                }
            });
        }

        function setPresence(eventId) {
            $.ajax({
                type: "GET",
                url: "event/" +eventId+ "/presence",
                success: function (response) {
                    showModal('modal-presence', response);
                }
                
            });
        }

        function setAbsense(eventId) {
            $.ajax({
                type: "GET",
                url: "event/" +eventId+ "/absense",
                success: function (response) {
                    showModal('modal-absense', response);
                }
            });
        }

        function rescheduleClass(eventId) {
            $.ajax({
                type: "GET",
                url: "event/" +eventId+ "/reschedule",
                success: function (response) {
                    showModal('modal-reschedule', response);
                }
            });
        }

        function sendForms(form) {
            var form = $('#' + form)
            $.ajax({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: $(form).serialize(),
                success: function (response) {
                    $('.modal').modal('hide')
                    refresh(null)
                },
                error: function (reject) {
                    console.log(reject)
                    if( reject.status === 422 ) {
                        var errors = $.parseJSON(reject.responseText);

                        console.log(errors)

                        $.each(errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                    }
                }
            });
        }


        function showModal(modalId, data) {
            $('#modal-container #' + modalId).remove();
            $('#modal-container').append(data);
            $('#modal-container .select2').select2( {"theme":"bootstrap4"} );
            $('#' + modalId).modal('show');
        }

        
</script>
@endsection