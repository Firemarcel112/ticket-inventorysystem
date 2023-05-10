@extends('errors::minimal')

@section('title', __('Unautorisiert'))
@section('code', '405')
@section('message', __('Sie sind nicht autorisiert diese Seite aufzurufen!'))
