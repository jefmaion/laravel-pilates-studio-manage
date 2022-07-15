@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
<x-package-pageheader title="Aulas de {{ $student->user->nickname }}" icon="fa fa-users" breadcrumb >
    <x-package-breadcrumb-item label="Alunos" href="{{ route('student.index') }}" />
    <x-package-breadcrumb-item label="Aulas de {{ $student->user->name }}" />
</x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="secondary" theme-mode="outline">

    <div class="row">
        <div class="col">
            <x-package-button-link  theme="success" label="Adicionar Aulas" url="{{ route('student.class.create', $student) }}" icon="fas fa-plus" />
        </div>
        <div class="col">
            <div class="text-muted text-right">
                {{-- {{ count($students) }} aluno(s) cadastrado(s) --}}
            </div>
        </div>
    </div>

    <hr>

    <x-adminlte-datatable id="table1" :heads="['Data', 'Hora', 'Professor', 'Ações']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
        @foreach($student->classes as $class)
            <tr>
              
                <td>{{ $class->date }}</td>
                <td>{{ $class->time }}</td>
                <td>{{ $class->instructor->user->name }}</td>
                <td class="">
                    <x-package-row-menu 
                        data-id="{{ $student->id }}" 
                        url-edit="{{ route('student.edit', $student->id) }}" 
                        url-delete="{{ route('student.destroy', $student->id) }}" 
                        :others="[
                            ['divider','url' => route('student.class.index', $student),'icon'=> 'fas fa-calendar','label' => 'Aulas']
                        ]"
                    />
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    
</x-adminlte-card>
@stop