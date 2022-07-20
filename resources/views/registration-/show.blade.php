@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Informações da Matrícula" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Alunos" href="{{ route('student.index') }}" />
        <x-package-breadcrumb-item label="Matrículas de {{ $student->user->name }}" href="{{ route('student.registration.index', $student) }}"  />
        <x-package-breadcrumb-item label="Informações" />
    </x-package-pageheader>
@stop

@section('content')




<x-adminlte-card theme="purple" theme-mode="outline">

    <h2><strong>{{ $student->user->name }}</strong></h2>
    <p><b>Plano: </b>{{ $registration->plan->name }}</p>
    <p><b>Vigência:</b> {{ $registration->date_start }} até {{ $registration->date_end }} </p>
    <p><b>Status:</b> {{ $registration->status }} </p>

    <hr>


    <h5 class="text-muted"><strong>Mensalidades</strong></h5>

    <div class="row">
        <div class="col-6">
            @if($registration->transactions)

            {{-- <x-adminlte-datatable id="table1" :heads="['Data', 'Valor',  'Status', ]" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable > --}}
                
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @foreach ($registration->transactions as $transaction)
                <tr>
                    <td>{{ $transaction->date }}</td>    
                    <td>{{ $transaction->value }}</td>    
                    <td>
                        <span class="badge badge-pill badge-secondary">
                            Aberto
                        </span>    
                    </td>    
                </tr>
                @endforeach

            </table>
                
            {{-- </x-adminlte-datatable> --}}
            @endif
        </div>

    </div>


    <x-package-button-link class="bg-purple" label="Voltar" theme="light"  url="{{ url()->previous() }}" icon="fas fa-chevron-left" />
    
    
</x-adminlte-card>
@stop