
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Informações da Matrícula" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Matrículas" href="{{ route('registration.index') }}" />
        <x-package-breadcrumb-item label="Informações" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="purple" theme-mode="outline">
    <div class="invice border-0">

       
    
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address>
                    <strong>{{ $registration->student->user->name }}</strong><br>
                    Plano: {{ $registration->plan->name }}<br>
                    Aulas na semana: {{ $registration->class_per_week }}<br>
                    Período: {{ $registration->dateStartFormated }} até {{ $registration->dateEndFormated }}<br>
                </address>

                <x-package-button-link label="Voltar" theme="secondary"  url="{{ route('registration.index') }}" icon="fas fa-chevron-left" />

                @if($registration->status == 'A')

                <x-adminlte-button data-toggle="modal" data-target="#modalPurple" label="Cancelar Matrícula" theme="danger"  icon="fas fa-ban"/>

                {{-- Themed --}}


     

                <form action="{{ route('registration.cancel', $registration) }}" method="POST">
                    <x-adminlte-modal id="modalPurple" v-centered title="Cancelar Matrícula" theme="purple" icon="fas fa-ban" disable-animations>
                        
                        <p>Deseja cancelar a matrícula?</p>

                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="C">

                            <x-adminlte-select2 name="cancel_type_id" id="select-instructor"  enable-old-support> 
                                <option value=""></option>
                                @foreach($cancelTypes as $type)
                                <x-adminlte-options :options="[$type->id => $type->name]"   />
                                @endforeach
                            </x-adminlte-select2>

                        <x-adminlte-textarea name="cancel_comments" rows="3"  enable-old-support placeholder="Motivo do cancelamento"></x-adminlte-textarea>

                        <x-slot name="footerSlot">
                            <x-adminlte-button type="submit"  class="bg-purple" icon="fas fa-ban" label="Cancelar Matrícula"/>
                            <x-adminlte-button theme="secondary" label="Fechar" data-dismiss="modal"/>
                        </x-slot>

                    </x-adminlte-modal>
                </form>

                @section('plugins.Select2', true)


                @endif
                {{-- Example button to open modal --}}
                
            </div>
        </div>
    </div>
</x-adminlte-card>


<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="false">
                    Mensalidades
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">
                    Aulas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="true">
                    Evoluções
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">

            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Vencimento</th>
                                    <th>Status</th>
                                    <th>Pago em</th>
                                    <th>Forma de Pagamento</th>
                                    <th>Valor do Plano</th>
                                    <th>Desconto (%)</th>
                                    <th>Valor Final</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registration->transactions as $transaction)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($transaction->date)) }}</td>
                                   
                                    <td>
                                        @if($transaction->is_payed)
                                            <span class="badge badge-pill badge-success">Pago</span>
                                        @else
                                            @if(!$transaction->is_payed && (date('Y-m-d') > date('Y-m-d', strtotime($transaction->date))))
                                                <span class="badge badge-pill badge-warning">Atrasado</span>
                                            @else
                                                <span class="badge badge-pill badge-secondary">Aberto</span>
                                            @endif
                                        
                                        @endif
                                    </td>
                                    <td> {{ $transaction->pay_day ?  date('d/m/Y', strtotime($transaction->pay_day)) : '-' }}</td>
                                    <td>{{ $transaction->paymentMethod->name ?? ''  }}</td>
                                    <td>{{ $registration->value }}</td>
                                    <td>{{ $registration->discount ?? '-' }}</td>
                                    <td> R$ {{ $transaction->valueFormated }}</td>
                                   
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
            
                </div>
            
                <div class="row">
            
                    <div class="col-8">

                    </div>
            
                    <div class="col-4">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width:50%">Total:</th>
                                        <td>R$ {{ $registration->sumAmount }}</td>
                                    </tr>

                                    <tr>
                                        <th>Em Aberto:</th>
                                        <td>R$ {{ $registration->sumAmountDebit }}</td>
                                    </tr>

                                    <tr>
                                        <th>Pago:</th>
                                        <td>R$ {{ $registration->sumAmount - $registration->sumAmountDebit }}</td>
                                    </tr>
                                  

                                    <tr>
                                        <th>Saldo Devedor:</th>
                                        <td>R$  {{  $registration->sumAmount - ( $registration->sumAmount - $registration->sumAmountDebit) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            
                </div>
            </div>

            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                <x-adminlte-datatable id="table-class" :heads="['Data', 'Horario', 'Professor','Tipo de Aula', 'Status', 'Professor Minist']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
                    @foreach($registration->classes as $class)
                    <tr>
                        <td>
                            {{ $class->dateFormated}}  <span class="text-muted"><small>
                                {{ $class->weekdayName }}</small></span>
                         </td> 

                        <td>
                            {{ $class->time }}
                        </td>

                        <td>
                            {{ $class->instructor->user->name }}
                        </td>


                        <td>
                            {{ $class->classType->name}}
                        </td>

                    

                     
                        <td>
                            <span class="badge badge-pill badge-{{ (($class->status == "A") ? 'secondary' : (($class->status == 'E') ? 'success' : 'danger')) }}">{{ $class->classStatus }}</span>
                        </td>

       


                        <td>
                            {{ $class->instructorExecuted->user->name ?? '' }}
                        </td>

                       
                    </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>

            <div class="tab-pane fade " id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
            </div>

            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
            </div>

        </div>
    </div>

</div>



@stop