@extends('layout')

@section('title', $seoInfo->seo_title ?? \App\Models\MaterielTask::homeH1(app()->getLocale()))
@section('description', $seoInfo->seo_desc ?? '')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "{{ config('app.name') }}",
    "url": "{{ url('/') }}"
}
</script>
@endsection

@section('content')
<div id="home">
    <div class="container pb-5 py-md-5">
        <div class="row">
            {{-- Left column: main news / latest articles --}}
            <div class="left">
                <div class="news">
                    <h1>{{ $seoInfo->h1 ?? \App\Models\MaterielTask::homeH1(app()->getLocale()) }}</h1>

                    @if(isset($latestBlogs) && $latestBlogs->count())
                    @php $firstBlog = $latestBlogs->first(); @endphp
                    @include('partials.newsitem', ['blog' => $firstBlog, 'showIntro' => true])

                    @foreach($latestBlogs->skip(1) as $blog)
                    <a href="{{ $blog->url }}" class="item-small">
                        <div class="date">{{ $blog->published_at ? $blog->published_at->format('d M') : '' }}</div>
                        <div class="title">{{ $blog->title }}</div>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>

            {{-- Right column: articles grouped by category --}}
            @if(isset($blogs) && $blogs->count())
            <div class="right">
                @foreach($blogs as $categoryId => $categoryBlogs)
                @php $firstInGroup = $categoryBlogs->first(); @endphp
                <div class="featured-news-category mt-5">
                    <h2>{{ $firstInGroup->category_name ?? '' }}</h2>

                    @include('partials.newsitem', ['blog' => $firstInGroup, 'showIntro' => true])

                    @foreach($categoryBlogs->skip(1) as $blog)
                    <a href="{{ $blog->url }}" class="item-small">
                        <div class="date">{{ $blog->published_at ? $blog->published_at->format('d M') : '' }}</div>
                        <div class="title">{{ $blog->title }}</div>
                    </a>
                    @endforeach

                    @if($firstInGroup->category)
                    <a href="{{ $firstInGroup->category->url }}" class="btn btn-primary view-all-items-button">
                        {{ \App\Models\MaterielTask::read_article(app()->getLocale()) }}
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            {{-- Sidebar: hot articles --}}
            @if(isset($hotBlogs) && $hotBlogs->count())
            <div class="a-sidebar">
                <div class="hot-sidebar">
                    <h2>{{ \App\Models\MaterielTask::hot_topics(app()->getLocale()) }}</h2>
                    @foreach($hotBlogs as $hot)
                    <a href="{{ $hot->url }}" class="hot-item">
                        @if($hot->head_img)
                        <img src="{{ $hot->head_img }}" alt="{{ $hot->head_img_alt ?: $hot->title }}" class="hot-img" loading="lazy" decoding="async">
                        @endif
                        <div class="hot-title">{{ $hot->title }}</div>
                        <div class="hot-date">{{ $hot->published_at ? $hot->published_at->format('d M Y') : '' }}</div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
