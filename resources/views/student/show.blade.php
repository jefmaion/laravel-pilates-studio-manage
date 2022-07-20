
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Informações do Aluno" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Alunos" href="{{ route('student.index') }}" />
        <x-package-breadcrumb-item label="Informações" />
    </x-package-pageheader>
@stop

@section('content')

<div class="row">
    <div class="col-8">
        <x-adminlte-card theme="secondary" tsheme-mode="outline">
            <h2 class="font-weight-light">{{ $student->user->name }}</h2>
            <div class="text-muted">
                <div> <i class="fa fa-phone" aria-hidden="true"></i> {{ $student->user->phone }} / {{ $student->user->phone2 }}</div>
                <div> <i class="fas fa-envelope    "></i> {{ $student->user->email }}</div>
                <div> <i class="fa fa-address-book" aria-hidden="true"></i> {{ $student->user->address }} {{ $student->user->district }} {{ $student->user->city }} {{ $student->user->state }}</div>
                <div></div>
            </div>
        </x-adminlte-card>
    </div>
</div>

<div class="card card-purple card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

            <li class="nav-item">
                <a class="nav-link lead active" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">
                   <i class="fas fa-book-open    "></i>
                    Matrículas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link lead" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    Aulas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  lead" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">
                    <i class="fas fa-money-check    "></i>
                    Mensalidades
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">



            <div class="tab-pane fade active show" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                
                
                <x-adminlte-datatable id="table1" :heads="['Data da Matrícula', 'Status', 'Plano']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
                    @foreach($student->registrations as $registration)
                        <tr>
                            <td>{{ $registration->date_start }}</td> 
                            
                            <td>
                                <span class="badge badge-pill badge-{{ $registration->labelTheme }}">{{ $registration->labelStatus }}</span>
                            </td>
                            <td>{{ $registration->plan->name }} </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>

            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                <x-adminlte-datatable id="table-class" :heads="['Dia', 'Semana', 'Horario', 'Professor', 'Status']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
                    @foreach($student->classes as $class)
            
            
                        <tr>
                            <td>{{ $class->weekdayName }}</td>
                            <td>{{ date('d/m/Y', strtotime($class->date)) }} {{ $class->time }} </td>
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
            
                                <span class="badge badge-pill badge-secondary">Agendada</span>
                            </td>
                           
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>

            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                <x-adminlte-datatable id="table-transaction" :heads="['Data', 'Descrição', 'Valor', 'Status']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
                    @foreach($student->transactions as $transaction)
            
            
                        <tr>
                          <td>{{ $transaction->date }}</td>
                          <td>{{ $transaction->description }}</td>
                          <td>{{ $transaction->value }}</td>
                          <td>
            
                            <span class="badge badge-pill badge-info">Agendada</span>
                        </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

</div>

@stop