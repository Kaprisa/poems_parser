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
        <nav class="nav">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="/poemsru/public/" class="nav__link">Главная</a>
                </li>
                <li class="nav__item">
                    <a href="/poemsru/public/poems" class="nav__link">Произведения</a>
                </li>
                <li class="nav__item">
                    <a href="/poemsru/public/authors" class="nav__link">Авторы</a>
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