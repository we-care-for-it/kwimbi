@extends('errors::minimal')

@section('title', __('Algemene foutmelding'))
@section('code', '500')
@section('message', __($exception->getMessage() ?: 'Er is een onbekende fout opgetreden. De beheerder is van deze foutmelding op de hoogte gesteld.'))
