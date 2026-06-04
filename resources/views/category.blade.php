@extends('layout')

@section('title', isset($seoInfo) ? $seoInfo->seo_title : $categoryInfo->name)
@section('description', isset($seoInfo) ? $seoInfo->seo_desc : '')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "{{ $categoryInfo->name }}",
    "url": "{{ url($categoryInfo->url ?? '/'.$categoryInfo->slug) }}"
    @if(isset($crumbs) && count($crumbs) > 1)
    ,"breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            @foreach($crumbs as $i => $crumb)
            {
                "@type": "ListItem",
                "position": {{ $i + 1 }},
                "name": "{{ $crumb['title'] }}",
                "item": "{{ $crumb['absolute_url'] }}"
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ]
    }
    @endif
}
</script>
@endsection

@section('header_extra')
@include('partials.breadcrumb', ['crumbs' => $crumbs ?? []])
@endsection

@section('content')
<div id="news-overview" class="container py-5">
    <div class="row">
        <div class="page-content">
            <div class="top-row">
                <h1>{{ $categoryInfo->name }}</h1>
                @if(isset($categories) && $categories->count() > 1)
                <div class="cat-select-group">
                    <select id="news-category-select" aria-label="Select category">
                        @foreach($categories as $cat)
                        <option value="{{ $cat->url }}" {{ $cat->id == $categoryInfo->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

            <div id="article-list-container">
                @include('partials.article-list', ['blogs' => $blogs])
            </div>

            @include('partials.pagination', ['paginator' => $blogs])
        </div>

        @if(isset($hotBlogs) && $hotBlogs->count())
        <div class="a-sidebar">
            <div class="hot-sidebar">
                <h2>{{ \App\Models\MaterielTask::popular_articles(app()->getLocale()) }}</h2>
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
@endsection
