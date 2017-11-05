<div class="pagination">
    <div class="pagination__pages">
        <a href="/poemsru/public/{{ $page }}?page={{ $current > 1 ? $current - 1 : 1 }}" class="pagination__link"> < </a>
        @for($i = 1 ; $i < $pages + 1 ; $i ++)
            <a href="/poemsru/public/{{ $page }}?page={{$i}}" class="pagination__link  {{ $current === $i ? 'pagination__link_active' : '' }}">{{ $i }}</a>
        @endfor
        <a href="/poemsru/public/{{ $page }}?page={{ $current < $pages ? $current + 1 : $pages }}" class="pagination__link"> > </a>
    </div>
    <div class="pagination__info">
        <span class="pagination__text"> Страница {{ $current  }} из {{ $pages }}</span>
    </div>
</div>

