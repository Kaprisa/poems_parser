@extends('layout')
@section('content')
    <h1 class="title">Наши авторы</h1>
    <div class="authors__cards" id="items-holder">
        @include('authors_list')
    </div>
    @include('pagination')
@endsection