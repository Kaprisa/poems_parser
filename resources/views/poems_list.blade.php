@foreach ($poems as $poem)
    <li class="list__item dropdown">
        <a href="http://stihi.ru/{{ $poem->identifier  }}" data-id="{{ $poem->id }}" class="poems__link">{{ $poem->name }}</a>
        <a href="http://stihi.ru/avtor/{{ $poem->author->identifier }}" class="poems__author">{{ $poem->author->name }}</a>
    </li>
@endforeach