@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Matrículas" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Matrículas" href="{{ route('registration.index') }}" />
        <x-package-breadcrumb-item label="Listagem de Matrículas" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="secondary" theme-mode="outline">

    <div class="row">
        <div class="col">
            <x-package-button-link  theme="success" label="Nova Matrícula" url="{{ route('registration.create') }}" icon="fas fa-plus" />
        </div>
        <div class="col">
            <div class="text-muted text-right">
                {{ count($registrations) }} matrículas(s) cadastrado(s)
            </div>
        </div>
    </div>

    

    <hr>

    <x-adminlte-datatable id="table1" :heads="['Aluno', 'Plano', 'Finaliza em', 'Ações']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
        @foreach($registrations as $registration)
            <tr>
              
                <td>{{ $registration->student->user->name }}</td>
                <td>{{ $registration->plan->name }}</td>
                <td>{{ $registration->date_end }}</td>
             
                <td class="">
                    <x-package-row-menu 
                        data-id="{{ $registration->id }}" 
                        url-edit="{{ route('registration.edit', $registration->id) }}" 
                        url-delete="{{ route('registration.destroy', $registration->id) }}" 
                    />
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    
</x-adminlte-card>
@stop