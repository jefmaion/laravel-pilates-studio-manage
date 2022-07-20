@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Agenda" icon="fa fa-calendar" breadcrumb >
        <x-package-breadcrumb-item label="Planos" href="{{ route('plan.index') }}" />
        <x-package-breadcrumb-item label="Listagem de Planos" />
    </x-package-pageheader>
@stop

@section('content')

<div id="fcalendar"></div>

   
@stop


@section('plugins.Fullcalendar', true)

@section('js')
<script>


        // Test Fullcalendar

        var calendarEl = document.getElementById('fcalendar')

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['bootstrap', 'dayGrid'],
            themeSystem: 'bootstrap'
        });

        calendar.render();

</script>
@endsection