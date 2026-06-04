<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\MaterielTask::page_not_found(app()->getLocale()) }} — {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
    <nav>
        <div id="nav-top">
            <div class="container">
                <a href="{{ url('/') }}" class="logo-holder">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}">
                </a>
            </div>
        </div>
        <div id="nav-bottom">
            <div class="container">
                <ul id="main-menu" role="menubar" aria-label="Main navigation">
                    <li><a href="{{ url('/') }}">{{ \App\Models\MaterielTask::home(app()->getLocale()) }}</a></li>
                    @if(isset($categories))
                    @foreach($categories as $cat)
                    <li><a href="{{ $cat->url }}">{{ $cat->name }}</a></li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <div class="container py-5">
        <div class="error-page text-center">
            <div class="error-code">404</div>
            <h1>{{ \App\Models\MaterielTask::page_not_found(app()->getLocale()) }}</h1>
            <p>{{ \App\Models\MaterielTask::desc_1_404(app()->getLocale()) }}</p>
            <p>{{ \App\Models\MaterielTask::desc_2_404(app()->getLocale()) }}</p>
            <a href="{{ url('/') }}" class="btn btn-primary">
                {{ \App\Models\MaterielTask::go_to_homepage(app()->getLocale()) }}
            </a>

            @if(isset($categories) && $categories->count())
            <div class="error-categories mt-5">
                <h2>{{ \App\Models\MaterielTask::popular_destinations(app()->getLocale()) }}</h2>
                <ul class="cat-list">
                    @foreach($categories as $cat)
                    <li><a href="{{ $cat->url }}">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</main>

<footer>
    <div id="footer-bottom">
        <div class="container">
            <span>&copy; {{ config('app.name') }} {{ date('Y') }} &mdash; {{ \App\Models\MaterielTask::copyright(app()->getLocale()) }}</span>
        </div>
    </div>
</footer>

<script src="{{ asset('js/main.js') }}" defer></script>
</body>
</html>
