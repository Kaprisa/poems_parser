@extends('layout')
@section('content')
    @include('lists')
    <h3 class="title">Конкурсы</h3>
    <section class="contests">
        @foreach($contests as $contest)
            <div class="contests__item">
                <a href="https://www.stihi.ru{{ $contest->link  }}" class="contests__item">
                    <img class="contests__img" src="http://www.stihi.ru/{{ $contest->image }}" alt="">
                </a>
                {{ $contest->text }}
            </div>
        @endforeach
    </section>
    @include('popup')
@endsection


