@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')   
    <x-package-pageheader title="Planos" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Planos" href="{{ route('plan.index') }}" />
        <x-package-breadcrumb-item label="Listagem de Planos" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="purple" theme-mode="outline">

    <div class="row">
        <div class="col">
            <x-package-button-link class="bg-purple"   label="Novo Plano" url="{{ route('plan.create') }}" icon="fas fa-plus" />
        </div>
        <div class="col">
            <div class="text-muted text-right">
                {{ count($plans) }} planos(s) cadastrado(s)
            </div>
        </div>
    </div>

    

    <hr>

    <x-adminlte-datatable id="table1" :heads="['Descrição', 'Duração', 'Aulas por Semana', 'Valor','Ações']" :config="['order' => [], 'language' => ['url' =>  asset('js/datatable.ptbr.json')]]"  head-thsme="light" themse="light" striped hoverable >
        @foreach($plans as $plan)
            <tr>
              
                <td>{{ $plan->name }}</td>
                <td>{{ $plan->duration }}</td>
                <td>{{ $plan->class_per_week }}</td>
                <td>{{ $plan->value }}</td>
                <td class="">
                    <x-package-row-menu 
                        data-id="{{ $plan->id }}" 
                        url-edit="{{ route('plan.edit', $plan->id) }}" 
                        url-delete="{{ route('plan.destroy', $plan->id) }}" 
                    />
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    
</x-adminlte-card>
@stop