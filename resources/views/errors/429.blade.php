@extends('errors::minimal')

@section('title', __('Zu viele Anfragen'))
@section('code', '429')
@section('message', __('Zu viele Anfragen, versuchen sie es etwas später erneut!'))
