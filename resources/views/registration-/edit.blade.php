@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-package-pageheader title="Matrícula - Editar" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Matrícula" href="{{ route('student.registration.index', $student) }}" />
        <x-package-breadcrumb-item label="{{ $registration->name }}" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="purple" theme-mode="outline">
    @include('registration.form')
</x-adminlte-card>
@stop

