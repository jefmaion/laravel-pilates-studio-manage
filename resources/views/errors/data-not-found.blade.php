

@extends('adminlte::page')

@section('title', __('Not Found'))

@section('content_header')   

@stop

@section('content')
<div class="error-page">
    <h2 class="headline text-warning"> 404</h2>

    <div class="error-content">
      <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Registro não encontrado.</h3>

      <p>
        Não conseguimos encontrar esse registro.
        Para voltar a página anterior, <a href="{{ url()->previous() }}">clique aqui</a> ou acesse o menu lateral.
      </p>

</div>
@stop


