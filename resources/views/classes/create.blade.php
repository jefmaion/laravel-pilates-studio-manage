@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-package-pageheader title="Matrículas" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Matrículas" href="{{ route('student.registration.index', $student) }}" />
        <x-package-breadcrumb-item label="Nova Matrícula" />
    </x-package-pageheader> 
@stop

@section('content')
<x-adminlte-card theme="secondary" theme-mode="outline">

        <h2>Aulas de {{ $student->user->name }}</h2>
        <hr>

        @include('classes.form')
</x-adminlte-card>
@stop

