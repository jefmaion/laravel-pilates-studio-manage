@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Matrículas de {{ $student->user->name }} " icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Alunos" href="{{ route('student.index') }}" />
        <x-package-breadcrumb-item label="Matrículas de {{ $student->user->name }}"  />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="purple" theme-mode="outline">

    <div class="row">
        <div class="col">
            @if(!$registration)
            <x-package-button-link class="bg-purple"   label="Nova Matrícula" url="{{ route('student.registration.create', $student) }}" icon="fas fa-plus" />
            @endif
        </div>
        <div class="col">
            <div class="text-muted text-right">
            
            </div>
        </div>
    </div>

    <hr>

    <x-adminlte-datatable id="table1" :heads="['Plano', 'Status', 'Fim', 'Ações']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
        @if($registration)
            <tr class="{{ ($registration->status == 'C') ? 'text-gray' : '' }}">
              
                <td>{{ $registration->plan->name }} </td>
                <td>
                    <span class="badge badge-pill badge-{{ $registration->labelTheme }}">{{ $registration->labelStatus }}</span>
                </td>
                <td>{{ $registration->date_end }}</td>
             
                <td class="">
                    <div class="btn-group">

                        <a class="text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </a>
                    
                        <div class="dropdown-menu">
                    
                            <h6 class="dropdown-header text-left">Ações</h6>

                            <a class="dropdown-item" href="{{ route('student.registration.show',[$student, $registration]) }}" >
                                <i class="fas fa-edit"></i>
                                Informações
                            </a>

                            @if($registration->status != 'C')
                    
                            <a class="dropdown-item" href="{{ route('student.registration.edit',[$student, $registration]) }}">
                                <i class="fas fa-edit"></i>
                                Editar
                            </a>

                            <a class="dropdown-item" data-toggle="modal" data-target="#modal-cancel-confirm-{{ $registration->id }}" href="#">
                                <i class="fas fa-edit"></i>
                                Cancelar
                            </a>

                            @endif

                            {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-cancel-{{ $registration->id }}">
                                <i class="fas fa-edit"></i>
                                Histórico
                            </a> --}}
                    
                            {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-delete-{{ $registration->id }}">
                                <i class="fas fa-trash-alt"></i>
                                Excluir
                            </a> --}}

                        </div>
                    
                    
                        <x-adminlte-modal id="modal-delete-{{ $registration->id }}" v-centered title="Excluir" icon="fas fa-trash" theme="danger">
                            Deseja excluir esse registro?
                            <x-slot name="footerSlot">
                                <form action="{{ route('student.registration.destroy', [$student, $registration]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-adminlte-button type="submit" icon="fa fa-trash" theme="danger" label="Excluir"/>
                                </form>
                    
                                <x-adminlte-button theme="light" icon="fa fa-times"  label="Fechar" data-dismiss="modal"/>
                            </x-slot>
                        </x-adminlte-modal>


                        <x-adminlte-modal id="modal-cancel-confirm-{{ $registration->id }}" v-centered title="Cancelar" icon="fas fa-trash" theme="warning">
                            Deseja cancelar essa matrícula
                            <x-slot name="footerSlot">
                                <x-adminlte-button icon="fa fa-trash" theme="warning" label="Excluir" data-dismiss="modal" data-toggle="modal" data-target="#modal-cancel-{{ $registration->id }}" />
                                <x-adminlte-button theme="light" icon="fa fa-times"  label="Fechar" data-dismiss="modal"/>
                            </x-slot>
                        </x-adminlte-modal>

                        <form action="{{ route('student.registration.cancel', [$student, $registration]) }}" method="post">    
                            <x-adminlte-modal id="modal-cancel-{{ $registration->id }}" v-centered title="Cancelar Matrícula" icon="fas fa-trash" theme="danger">
                                @csrf
                                @method('PUT')
                                <x-adminlte-textarea name="cancel_comments" rows="3" fgroup-class="col-12  col-lg-12 col-sm-6" enable-old-support></x-adminlte-textarea>
                                <x-slot name="footerSlot">
                                        <x-adminlte-button type="submit" icon="fa fa-trash" theme="danger" label="Cancelar"/>
                                    
                        
                                    <x-adminlte-button theme="light" icon="fa fa-times"  label="Fechar" data-dismiss="modal"/>
                                </x-slot>
                            </x-adminlte-modal>
                        </form>
                    </div>
                </td>
            </tr>
            @endif
          </x-adminlte-datatable>
    
</x-adminlte-card>
@stop