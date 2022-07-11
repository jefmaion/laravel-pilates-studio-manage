
{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}



@extends('adminlte::page')

@section('title', __('Not Found'))

@section('content_header')   

@stop

@section('content')
404 | {{ __('Not Found') }}
@stop


