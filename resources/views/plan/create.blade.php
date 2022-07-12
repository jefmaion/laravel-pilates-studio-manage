@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-package-pageheader title="Planos" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Planos" href="{{ route('plan.index') }}" />
        <x-package-breadcrumb-item label="Novo Plano" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="secondary" theme-mode="outline">
    <form action="{{ route('plan.store') }}" method="post">
        @include('plan.form')
        
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
        <x-package-button-link label="Voltar" theme="light"  url="{{ route('plan.index') }}" icon="fas fa-chevron-left" />
    </form>
</x-adminlte-card>
@stop

