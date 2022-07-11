@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-package-pageheader title="Alunos - Editar" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Alunos" href="{{ route('student.index') }}" />
        <x-package-breadcrumb-item label="{{ $student->user->name }}" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="secondary" theme-mode="outline">
    <form action="{{ route('student.update', $student) }}" method="post">
        @method('PUT')
        @include('user.form', ['user' => $student->user])
    </form>
</x-adminlte-card>
@stop

