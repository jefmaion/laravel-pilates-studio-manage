@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-package-pageheader title="Matrícula - Editar" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Matrícula" href="{{ route('registration.index') }}" />
        <x-package-breadcrumb-item label="{{ $registration->name }}" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="secondary" theme-mode="outline">
    <form action="{{ route('registration.update', $registration) }}" method="post">
        @method('PUT')
        @include('registration.form')
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
        <x-package-button-link label="Voltar" theme="light"  url="{{ route('registration.index') }}" icon="fas fa-chevron-left" />
    </form>
</x-adminlte-card>
@stop

