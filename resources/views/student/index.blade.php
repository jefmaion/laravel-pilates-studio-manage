@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Alunos" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Alunos" href="{{ route('student.index') }}" />
        <x-package-breadcrumb-item label="Listagem de Alunos" />
    </x-package-pageheader>
@stop

@section('content')

<x-adminlte-card theme="purple" theme-mode="outline">

    <div class="row">
        <div class="col">
            <x-package-button-link class="bg-purple"  class="bg-purple " label="Novo Aluno" url="{{ route('student.create') }}" icon="fas fa-plus" />
        </div>
        <div class="col">
            <div class="text-muted text-right">
                {{ count($students) }} aluno(s) cadastrado(s)
            </div>
        </div>
    </div>

    

    <hr>

    <x-adminlte-datatable id="table1" :heads="['Nome', 'Idade', 'Telefone', 'Email', 'Data do Cadastro' ,'Ações']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
        @foreach($students as $student)
            <tr>
              
                <td>{{ $student->user->name }}</td>
                <td>
                    {{ $student->user->age; }}
                  
                </td>
                <td>{{ $student->user->phone }}</td>
                <td>{{ $student->user->email }}</td>
                <td>{{ $student->user->created_at }}</td>
                <td class="">


                    <div class="btn-group">

                        <a class="text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </a>
                    
                        <div class="dropdown-menu">
                    
                            <h6 class="dropdown-header text-left">Ações</h6>

                            <a class="dropdown-item" href="{{ route('student.show', $student) }}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                Informações
                            </a>
                    
                            <a class="dropdown-item" href="{{ route('student.edit', $student) }}">
                                <i class="fas fa-edit"></i>
                                Editar
                            </a>
                    
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#moda-delete-{{ $student->id }}">
                                <i class="fas fa-trash-alt"></i>
                                Excluir
                            </a>
                    
                    

                        </div>
                    
                    
                        <x-adminlte-modal id="moda-delete-{{ $student->id }}" v-centered title="Excluir" icon="fas fa-trash" theme="danger">
                            Deseja excluir esse registro?
                            <x-slot name="footerSlot">
                                <form action="{{ route('student.destroy', $student) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-adminlte-button type="submit" icon="fa fa-trash" theme="danger" label="Excluir"/>
                                </form>
                    
                                <x-adminlte-button theme="light" icon="fa fa-times"  label="Fechar" data-dismiss="modal"/>
                            </x-slot>
                        </x-adminlte-modal>
                        
                    </div>
                    
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    
</x-adminlte-card>
@stop