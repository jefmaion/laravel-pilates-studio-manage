
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Informações da Matrícula" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Matrículas" href="{{ route('registration.index') }}" />
        <x-package-breadcrumb-item label="Listagem de Matrículas" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="secondary" theme-mode="outline">
    <h3><strong>{{ $registration->student->user->name }}</strong></h3>
    <div class="text-muted">
        <div>{{ $registration->student->user->address }} {{ $registration->student->user->number }}</div>
        <div>{{ $registration->student->user->district }}</div>
        <div>{{ $registration->student->user->city }} {{ $registration->student->user->state }}</div>
    </div>
</x-adminlte-card>

<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Informações</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Mensalidades</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Aulas</a>
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
                    <div class="col-6">
                        <div><strong>Plano: </strong>{{ $registration->plan->name }}</div>
                        <div><strong>Data de início: </strong>{{ $registration->date_start }}</div>
                        <div><strong>Data de término: </strong>{{ $registration->date_end }}</div>
                    </div>
                    <div class="col-6"></div>
                </div>

            </div>

            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
            </div>

            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
            </div>

            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
            </div>
        </div>
    </div>

</div>

@stop