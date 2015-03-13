@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}">Zurück zu Übersicht</a></li>
    <li><a href="{{route('customer.survey.index', $customer)}}">Alle Umfragen</a></li>
    <li><a href="{{route('customer.survey.show', [$customer, $survey])}}">Umfrage ansehen</a></li>
    <li class="uk-parent">
        <a href="#">Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p>Hier sehen Sie die Auswertung der gewählten Gruppe. <small>Diese Ansicht wird sich im laufe der Entwicklung weiter verändern.</small></p></li>
        </ul>
    </li>
@stop
@section('content')

@stop