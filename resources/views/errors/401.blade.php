@extends('errors::minimal')

@section('title', __('Keine Rechte zum aufrufen der Seite'))
@section('code', '401')
@section('message', __('Sie besitzen nicht die erforderlichen Rechte zum aufrufen der Rechte'))
