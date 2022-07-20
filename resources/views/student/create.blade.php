@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-package-pageheader title="Alunos - Cadastro" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Alunos" href="{{ route('student.index') }}" />
        <x-package-breadcrumb-item label="Novo Aluno" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="purple" theme-mode="outline">
    <form action="{{ route('student.store') }}" method="post">
        @include('user.form')
        <div class="row"><x-adminlte-textarea name="user[comments]" rows="3" label="Observações" fgroup-class="col-12  col-lg-12 col-sm-6" enable-old-support>{{ $user->comments ?? '' }}</x-adminlte-textarea></div>
        <hr>
        <x-package-button-link label="Voltar" theme="secondary"  url="{{ route('student.index') }}" icon="fas fa-chevron-left" />
        <x-adminlte-button type="submit" class="bg-purple" label="Salvar"  icon="fas fa-lg fa-save"/>
        
    </form>
</x-adminlte-card>
@stop

