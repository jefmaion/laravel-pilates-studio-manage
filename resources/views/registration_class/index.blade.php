@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Listagem de Aulas" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Matrículas" href="{{ route('registration.index') }}" />
        <x-package-breadcrumb-item label="{{ $registration->student->user->name }}"  /> 
            <x-package-breadcrumb-item label="Aulas" active />
    </x-package-pageheader>
@stop

@section('content')

<x-adminlte-card theme="secondary" theme-mode="outline">

    <div class="row">
        <div class="col">
            <x-package-button-link  theme="success" label="Adicionar Aulas" url="{{ route('registration.class.create', $registration) }}" icon="fas fa-plus" />
        </div>
        <div class="col">
            <div class="text-muted text-right">
               
            </div>
        </div>
    </div>

    

    <hr>

    <x-adminlte-datatable id="table1" :heads="['Dia', 'Semana', 'Horario', 'Professor', 'Status']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
        @foreach($classes as $class)


            <tr>
                <td>{{ $class->weekdayName }}</td>
                <td>{{ $class->date }} </td>
                <td>{{ $class->time }}</td>
                <td>
                    @if(!$class->instructorExecuted || $class->instructor->id == $class->instructorExecuted->id)
                    {{ $class->instructor->user->name }}
                    @else
                    <div class="text-muted"><s>{{ $class->instructor->user->name }}</s></div>
                    {{ $class->instructorExecuted->user->name ?? '' }}
                    @endif
                
                </td>
             
                <td>

                    <span class="badge badge-pill badge-info">Agendada</span>
                </td>
               
            </tr>
        @endforeach
    </x-adminlte-datatable>

    <hr>

    <x-package-button-link label="Voltar" theme="light"  url="{{ route('registration.index') }}" icon="fas fa-chevron-left" />
    
</x-adminlte-card>
@stop