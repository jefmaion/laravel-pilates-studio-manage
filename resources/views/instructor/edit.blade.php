@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-package-pageheader title="Professores - Editar" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Professores" href="{{ route('instructor.index') }}" />
        <x-package-breadcrumb-item label="{{ $instructor->user->name }}" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="purple" theme-mode="outline">
    <form action="{{ route('instructor.update', $instructor) }}" method="post">
        @method('PUT')
        @include('user.form', ['user' => $instructor->user])
        @include('user.instructor.form')
        <x-adminlte-button type="submit" label="Salvar"  icon="fas fa-lg fa-save"/>
        <x-package-button-link class="bg-purple" label="Voltar" theme="light"  url="{{ route('instructor.index') }}" icon="fas fa-chevron-left" />
    </form>
</x-adminlte-card>
@stop

