@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-package-pageheader title="Editar Matrícula" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Matrícula" href="{{ route('registration.index') }}" />
        <x-package-breadcrumb-item label="{{ $registration->student->user->name }}"  />
        <x-package-breadcrumb-item label="{{ $registration->name }}" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="secondary" theme-mode="outline">
    @include('registration.form')
</x-adminlte-card>
@stop

