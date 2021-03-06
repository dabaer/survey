@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('helptext')
    Kein Hilfetext
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.iteration.store',$customer)}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <fieldset>
                <legend>Neue Iteration</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="description" placeholder="Beschreibung">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('description')}}</p>
                        <p class="uk-form-help-block">Beschreiben Sie kurz welchen Zweck diese Ietration erfüllt. Z.B. <q>Teilnehmer und Gruppen 2015</q></p>
                    </div>
                </div>
            </fieldset>
            <div class="uk-form-row uk-margin-top">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-success uk-button-large">Erstellen</button>
            </div>
        </form>
@stop