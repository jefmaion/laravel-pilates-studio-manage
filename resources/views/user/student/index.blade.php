@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Alunos" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Alunos" href="{{ route('student.index') }}" />
        <x-package-breadcrumb-item label="Listagem de Alunos" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="secondary" theme-mode="outline">

    <div class="row">
        <div class="col">
            <x-package-button-link  theme="success" label="Novo Aluno" url="{{ route('student.create') }}" icon="fas fa-plus" />
        </div>
        <div class="col">
            <div class="text-muted text-right">
                {{ count($students) }} aluno(s) cadastrado(s)
            </div>
        </div>
    </div>

    

    <hr>

    <x-adminlte-datatable id="table1" :heads="['Nome', 'Telefone', 'Email', 'Ações']" :config="[ 'order' => [[1, 'asc']], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
        @foreach($students as $student)
            <tr>
              
                <td>{{ $student->user->name }}</td>
                <td>{{ $student->user->phone }}</td>
                <td>{{ $student->user->email }}</td>
                <td class="">
                    <x-package-row-menu 
                        data-id="{{ $student->id }}" 
                        url-edit="{{ route('student.edit', $student->id) }}" 
                        url-delete="{{ route('student.destroy', $student->id) }}" 
                    />
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    
</x-adminlte-card>
@stop