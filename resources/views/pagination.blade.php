<div class="pagination">
    <div class="pagination__pages">
        @if ($current > 1)
            <a href="/poemsru/public/{{ $page }}?page={{ $current - 1 }}" class="pagination__link"> < </a>
        @endif
        @for($i = 1 ; $i < $pages + 1 ; $i ++)
            <a href="/poemsru/public/{{ $page }}?page={{$i}}" class="pagination__link  {{ $current === $i ? 'pagination__link_active' : '' }}">{{ $i }}</a>
        @endfor
        @if ($current < $pages)
            <a href="/poemsru/public/{{ $page }}?page={{ $current + 1 }}" class="pagination__link"> > </a>
        @endif
    </div>
    <div class="pagination__info">
        <span class="pagination__text"> Страница {{ $current  }} из {{ $pages }}</span>
    </div>
</div>

