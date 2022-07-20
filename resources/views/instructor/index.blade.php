@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Professores" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Professores" href="{{ route('instructor.index') }}" />
        <x-package-breadcrumb-item label="Listagem de Professores" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="purple" theme-mode="outline">

    <div class="row">
        <div class="col">
            <x-package-button-link class="bg-purple"   label="Novo Professor" url="{{ route('instructor.create') }}" icon="fas fa-plus" />
        </div>
        <div class="col">
            <div class="text-muted text-right">
                {{ count($instructors) }} professores(s) cadastrado(s)
            </div>
        </div>
    </div>

    

    <hr>

    <x-adminlte-datatable id="table1" :heads="['Nome','Profissão', 'Telefone', 'Email', 'Ações']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
        @foreach($instructors as $instructor)
            <tr>
              
                <td>{{ $instructor->user->name }}</td>
                <td>{{ $instructor->profession }}</td>
                <td>{{ $instructor->user->phone }}</td>
                <td>{{ $instructor->user->email }}</td>
                <td class="">
                    <x-package-row-menu 
                        data-id="{{ $instructor->id }}" 
                        url-edit="{{ route('instructor.edit', $instructor->id) }}" 
                        url-delete="{{ route('instructor.destroy', $instructor->id) }}" 
                    />
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    
</x-adminlte-card>
@stop