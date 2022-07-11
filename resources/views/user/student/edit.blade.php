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
        <div class="row"><x-adminlte-textarea name="user[comments]" rows="3" label="Observações" fgroup-class="col-12  col-lg-12 col-sm-6" enable-old-support>{{ $user->comments ?? '' }}</x-adminlte-textarea></div>
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
        <x-package-button-link label="Voltar" theme="light"  url="{{ route('student.index') }}" icon="fas fa-chevron-left" />
    </form>
</x-adminlte-card>
@stop

