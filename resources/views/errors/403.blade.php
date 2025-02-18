@extends('errors::minimal')

@section('title', __('Geen toegang'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Geen toegang tot deze pagina'))
