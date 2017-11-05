<h2 class="title">Наша подборка стихотворений</h2>
<section class="section">
    @foreach ([1, 2, 5] as $index)
        <article class="poems">
            <h3 class="poems__title">{!! $poems[$index][0]->category->name !!}</h3>
            <ul class="poems__list list">
                @foreach ($poems[$index] as $poem)
                    <li class="list__item">
                        <a href="http://stihi.ru/{{ $poem->identifier  }}" data-id="{{ $poem->id }}" class="poems__link">{{ $poem->name }}</a>
                        <a href="http://stihi.ru/avtor/{{ $poem->author->identifier }}" class="poems__author">{{ $poem->author->name }}</a>
                    </li>
                @endforeach
            </ul>
        </article>
    @endforeach
</section>
<h2 class="title">Наши авторы</h2>
<section class="section">
    @foreach ([3, 4] as $index)
        <article class="authors">
            <h3 class="authors__title">{!! $authors[$index][0]->category->name !!}</h3>
            <ul class="authors__list list">
                @foreach ($authors[$index] as $author)
                    <li class="list__item">
                        <a href="http://stihi.ru/avtor/{{ $author->identifier }}" class="authors__link">{{ $author->name }}</a>
                    </li>
                @endforeach
            </ul>
        </article>
    @endforeach
</section>