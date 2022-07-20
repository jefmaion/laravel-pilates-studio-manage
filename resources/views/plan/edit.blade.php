@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-package-pageheader title="Planos - Editar" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Planos" href="{{ route('plan.index') }}" />
        <x-package-breadcrumb-item label="{{ $plan->name }}" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="purple" theme-mode="outline">
    <form action="{{ route('plan.update', $plan) }}" method="post">
        @method('PUT')
        @include('plan.form', ['plan' => $plan])
        <x-adminlte-button type="submit" label="Salvar"  icon="fas fa-lg fa-save"/>
        <x-package-button-link class="bg-purple" label="Voltar" theme="light"  url="{{ route('plan.index') }}" icon="fas fa-chevron-left" />
    </form>
</x-adminlte-card>
@stop

