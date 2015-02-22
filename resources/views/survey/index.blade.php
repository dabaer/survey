@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}">Zurück zu Übersicht</a></li>
    <li><a href="{{route('customer.survey.create', $customer)}}">Neue Umfrage beginnen</a></li>
    <li class="uk-parent">
        <a href="#">Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p></p></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="width-1-2">
                    <h1>Alle Umfragen</h1>
                </div>
            </div>
            <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                @foreach($surveys as $survey)
                    <div class="uk-width-1-2">
                        <div class="uk-panel uk-panel-box">
                            @if($survey->open)
                                <div class="uk-panel-badge uk-badge uk-badge-success">Offen</div>
                            @else
                                <div class="uk-panel-badge uk-badge uk-badge-danger">Geschlossen</div>
                            @endif
                            <h2 class="uk-panel-title">{{$survey->name}}</h2>
                            <div class="uk-grid">
                                <div class="uk-width-2-3">
                                    <dl class="uk-description-list-horizontal">
                                        <dt>Schließt</dt>
                                        <dd>{{$survey->end_date}}</dd>
                                        <dt>Fragebogen</dt>
                                        <dd>{{$survey->questionnaire}}</dd>
                                        <dt>Teilnehmer</dt>
                                        <dd>{{count($survey->members)}}</dd>
                                    </dl>
                                </div>
                                <div class="uk-width-1-3">
                                    <a class="uk-button uk-button-primary" href="{{route('customer.survey.edit',[$customer, $survey])}}">Bearbeiten</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop