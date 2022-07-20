@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Matrículas" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Matrículas" href="{{ route('registration.index') }}" />
        <x-package-breadcrumb-item label="Listagem de Matrículas" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="purple" theme-mode="outline">

    <div class="row">
        <div class="col">
            <x-package-button-link class="bg-purple"   label="Nova Matrícula" url="{{ route('registration.create') }}" icon="fas fa-plus" />
        </div>
        <div class="col">
            <div class="text-muted text-right">
                {{ count($registrations) }} matrículas(s) cadastrado(s)
            </div>
        </div>
    </div>

    

    <hr>

    <x-adminlte-datatable id="table1" :heads="['Aluno', 'Status',  'Plano', 'Próx. Vencimento', 'Data Renovação', 'Observações', 'Ações']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
        @foreach($registrations as $registration)
            <tr class="{{ ($registration->status == 'C') ? 'text-gray' : '' }}">
              
                <td>{{ $registration->student->user->name }}</td>
                <td>
                    <span class="badge badge-pill badge-block {{ $registration->labelTheme }}">{{ $registration->labelStatus }}</span>
                </td>
                <td>{{ $registration->plan->name }} </td>
                <td>
                    {{ $registration->nextPayment}}
                    <span class="text-muted"><small>({{ $registration->nextPaymentHuman ?? '' }})</small></span>
                    
                </td>
               
                <td>
                    {{ date('d/m/Y', strtotime($registration->date_end))}} 
                    <span class="text-muted"><small>({{ $registration->expirationLeft ?? '' }})</small></span>
                </td>
                <td> {{$registration->comments}}</td>
             
                <td class="">
                    <div class="btn-group">

                        <a class="text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </a>
                    
                        <div class="dropdown-menu">
                    
                            <h6 class="dropdown-header text-left">Ações</h6>

                            <a class="dropdown-item" href="{{ route('registration.show',  $registration) }}">
                                <i class="fas fa-edit"></i>
                                Informações
                            </a>


                            @if($registration->status != 'C')
                    
                            {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-cancel-{{ $registration->id }}">
                                <i class="fas fa-edit"></i>
                                Cancelar Matrícula
                            </a> --}}

                            
                            <a class="dropdown-item" href="{{ route('registration.edit',  $registration) }}">
                                <i class="fas fa-edit"></i>
                                Editar
                            </a>
{{-- 
                            <a class="dropdown-item" href="{{ route('registration.class.index',  $registration) }}">
                                <i class="fas fa-edit"></i>
                                Aulas
                            </a> --}}

                            @endif

                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-delete-{{ $registration->id }}">
                                <i class="fas fa-trash-alt"></i>
                                Excluir
                            </a>

                        </div>
                    
                    
                        <x-adminlte-modal id="modal-delete-{{ $registration->id }}" v-centered title="Excluir" icon="fas fa-trash" theme="danger">
                            Deseja excluir esse registro?
                            <x-slot name="footerSlot">
                                <form action="{{ route('registration.destroy', $registration) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-adminlte-button type="submit" icon="fa fa-trash" theme="danger" label="Excluir"/>
                                </form>
                    
                                <x-adminlte-button theme="light" icon="fa fa-times"  label="Fechar" data-dismiss="modal"/>
                            </x-slot>
                        </x-adminlte-modal>

                        <form action="#" method="post">    
                            <x-adminlte-modal id="modal-cancel-{{ $registration->id }}" v-centered title="Cancelar Matrícula" icon="fas fa-trash" theme="danger">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="C">
                                <x-adminlte-textarea name="cancel_comments" rows="3" fgroup-class="col-12  col-lg-12 col-sm-6" enable-old-support></x-adminlte-textarea>
                                <x-slot name="footerSlot">
                                        <x-adminlte-button type="submit" icon="fa fa-trash" theme="danger" label="Cancelar"/>
                                    </form>
                        
                                    <x-adminlte-button theme="light" icon="fa fa-times"  label="Fechar" data-dismiss="modal"/>
                                </x-slot>
                            </x-adminlte-modal>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    
</x-adminlte-card>
@stop