@foreach ($authors as $author)
    <a href="http://stihi.ru/avtor/{{ $author->identifier }}" class="card">
        <img class="card__photo" src="http://www.stihi.ru/photos/{{ $author->identifier }}.jpg" alt="">
        <span class="card__name">{{ $author->name  }}</span>
    </a>
@endforeach