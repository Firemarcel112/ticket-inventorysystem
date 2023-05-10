@extends('errors::minimal')

@section('title', __('Seite im Wartungsmodus'))
@section('message')
    <p class="text-center">Aktuell befinden wir uns im WartungsmodusFalls du weitere Hilfe benötigst, schreib uns per Schul.Cloud oder per E-Mail</p>
    <p class="text-center"><a class="hover:text-red-800" href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a></p>
@endsection
