<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Poems</title>
</head>
<body>
    <header class="header">
        <a href="/poemsru/public/" class="logo">
            <img class="logo__img" src="{{ asset('images/logo.svg') }}" alt="">
            <span class="logo__text">Poems.ru</span>
        </a>
        <nav class="nav">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="/poemsru/public/" class="nav__link {{ $page === 'welcome' ? 'nav__link_active' : '' }}">Главная</a>
                </li>
                <li class="nav__item">
                    <a href="/poemsru/public/poems" class="nav__link {{ $page === 'poems' ? 'nav__link_active' : '' }}">Произведения</a>
                </li>
                <li class="nav__item">
                    <a href="/poemsru/public/authors" class="nav__link {{ $page === 'authors' ? 'nav__link_active' : '' }}">Авторы</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>
</body>
</html>