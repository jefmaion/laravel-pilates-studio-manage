@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-package-pageheader title="Professores" icon="fa fa-users" breadcrumb >
        <x-package-breadcrumb-item label="Professores" href="{{ route('instructor.index') }}" />
        <x-package-breadcrumb-item label="Novo Professor" />
    </x-package-pageheader>
@stop

@section('content')
<x-adminlte-card theme="secondary" theme-mode="outline">
    <form action="{{ route('instructor.store') }}" method="post">
        @include('user.form')

        {{-- <div class="row">
            <x-adminlte-textarea name="user[comments]" rows="3" label="Observações" fgroup-class="col-12  col-lg-6 col-sm-6" enable-old-support>{{ $user->comments }}</x-adminlte-textarea>
        </div> --}}

        @include('user.instructor.form')
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
        <x-package-button-link label="Voltar" theme="light"  url="{{ route('instructor.index') }}" icon="fas fa-chevron-left" />
    </form>
</x-adminlte-card>
@stop

