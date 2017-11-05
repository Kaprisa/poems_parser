@extends('layout')
@section('content')
    @include('lists')
    <div class="popup poems__popup">
        <div class="popup__content">
            <h3 class="popup__title"></h3>
            <div class="popup__text"></div>
            <span class="btn_hide-popup"></span>
        </div>
    </div>
@endsection


