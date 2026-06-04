{{-- AJAX partial: renders just the article grid, no page chrome --}}
<div class="news-grid">
    @foreach($blogs as $blog)
    @include('partials.newsitem', ['blog' => $blog, 'showIntro' => true])
    @endforeach
</div>
