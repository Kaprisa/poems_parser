@extends('layout')
@section('content')
        <h1 class="title">Произведения наших авторов</h1>
        <ul class="poems-page__list list" id="items-holder">
            @include('poems_list')
        </ul>
        @include('popup')
        @include('pagination')
@endsection