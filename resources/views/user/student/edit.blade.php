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
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
        <x-package-button-link label="Voltar" theme="light"  url="{{ route('student.index') }}" icon="fas fa-chevron-left" />
    </form>
</x-adminlte-card>
@stop

