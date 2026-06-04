<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', isset($seoInfo) ? $seoInfo->seo_title : (isset($pageInfo) ? $pageInfo->seo_title : config('app.name')))</title>
    <meta name="description" content="@yield('description', isset($seoInfo) ? $seoInfo->seo_desc : (isset($pageInfo) ? $pageInfo->seo_desc : ''))">

    @if(isset($blog))
    <link rel="canonical" href="{{ $blog->absoluteUrl() }}">
    @elseif(isset($categoryInfo) && isset($categoryInfo->slug))
    <link rel="canonical" href="{{ url($categoryInfo->url ?? '/'.$categoryInfo->slug) }}">
    @else
    <link rel="canonical" href="{{ url(request()->path() === '/' ? '/' : request()->path()) }}">
    @endif

    @if(isset($alternate_tag))
    {!! $alternate_tag !!}
    @endif

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')

    @yield('schema')

    @if(isset($gtag) && $gtag)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gtag }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){ dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', '{{ $gtag }}', { 'anonymize_ip': true });
    </script>
    @endif
</head>

<body>
<header>
    <nav>
        {{-- Nav Top: logo + slogan + mobile toggles --}}
        <div id="nav-top">
            <div class="container">
                <a href="{{ url('/') }}" class="logo-holder">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Logo') }}">
                </a>

                <div class="nav-holder d-lg-none">
                    <div class="options">
                        <button id="search-toggle" class="toggle-button" aria-label="Search" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.099zm-5.242 1.656a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11"/></svg>
                        </button>
                        <button id="menu-toggle" class="toggle-button" aria-label="Toggle menu" aria-expanded="false" aria-controls="main-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/></svg>
                        </button>
                    </div>
                </div>

                @if(isset($seoInfo) && $seoInfo->slogan)
                <div class="slogan-holder">
                    <div class="content">
                        <div class="slogan">{{ $seoInfo->slogan }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Nav Bottom: main menu --}}
        <div id="nav-bottom">
            <div class="container">
                <ul id="main-menu" role="menubar" aria-label="Main navigation">
                    <li>
                        <button id="close-menu" class="toggle-button" aria-label="Close menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/></svg>
                        </button>
                    </li>
                    <li role="menuitem">
                        <a href="{{ url('/') }}" role="menuitem">{{ \App\Models\MaterielTask::home(app()->getLocale()) }}</a>
                    </li>
                    @if(isset($categories))
                    @foreach($categories as $cat)
                    <li role="menuitem">
                        <a href="{{ $cat->url }}" role="menuitem">{{ $cat->name }}</a>
                    </li>
                    @endforeach
                    @endif
                    @foreach(\App\Models\MaterielTask::SUPPORTS(app()->getLocale()) as $support)
                    <li role="menuitem">
                        <a href="{{ url('/'.$support['uri']) }}" role="menuitem">{{ $support['name'] }}</a>
                    </li>
                    @endforeach
                </ul>

                <div id="search-form" role="search">
                    <div class="input-group">
                        <input type="text" placeholder="Search..." aria-label="Search" id="search-input">
                        <button type="button" class="btn btn-primary" onclick="if(document.getElementById('search-input').value){window.location.href='/?q='+encodeURIComponent(document.getElementById('search-input').value)}" aria-label="Submit search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.099zm-5.242 1.656a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11"/></svg>
                        </button>
                    </div>
                </div>

                <div class="options">
                    <button id="search-toggle" class="toggle-button" aria-label="Search" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.099zm-5.242 1.656a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11"/></svg>
                    </button>
                    <button id="menu-toggle" class="toggle-button" aria-label="Toggle menu" aria-expanded="false" aria-controls="main-menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    @yield('header_extra')
</header>

<main>
    @yield('content')
</main>

<footer>
    <div id="footer-top">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <div class="menu-name">{{ \App\Models\MaterielTask::company(app()->getLocale()) }}</div>
                    <ul>
                        @foreach(\App\Models\MaterielTask::SUPPORTS(app()->getLocale()) as $support)
                        <li><a href="{{ url('/'.$support['uri']) }}">{{ $support['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer-col">
                    <div class="menu-name">{{ \App\Models\MaterielTask::resource(app()->getLocale()) }}</div>
                    <ul>
                        @if(isset($categories))
                        @foreach($categories->take(6) as $cat)
                        <li><a href="{{ $cat->url }}">{{ $cat->name }}</a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="footer-col">
                    <div class="menu-name">{{ \App\Models\MaterielTask::legal(app()->getLocale()) }}</div>
                    <ul>
                        @foreach(\App\Models\MaterielTask::SUPPORTS(app()->getLocale()) as $key => $support)
                        @if(in_array($key, [4, 7]))
                        <li><a href="{{ url('/'.$support['uri']) }}">{{ $support['name'] }}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="footer-bottom">
        <div class="container">
            <span>&copy; {{ config('app.name', 'Site') }} {{ date('Y') }} &mdash; {{ \App\Models\MaterielTask::copyright(app()->getLocale()) }}</span>
        </div>
    </div>
</footer>

<script src="{{ asset('js/main.js') }}" defer></script>
@stack('scripts')
</body>
</html>
