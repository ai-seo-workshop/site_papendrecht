@extends('layout')

@section('title', $blog->title)
@section('description', $blog->summary ?? '')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "{{ addslashes(strip_tags($blog->h1 ?? $blog->title)) }}",
    "datePublished": "{{ $blog->published_at ? $blog->published_at->toIso8601String() : '' }}",
    "author": {
        "@type": "Person",
        "name": "{{ $blog->author ?? config('app.name') }}"
    },
    "url": "{{ $blog->absoluteUrl() }}"
}
</script>
@if(isset($crumbs) && count($crumbs) > 1)
<script type="application/ld+json">
{
    "@context": "https://schema.org",
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
</script>
@endif
@if(isset($blog) && $blog->faq && count($blog->faq) > 0)
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        @foreach($blog->faq as $faqItem)
        {
            "@type": "Question",
            "name": "{{ addslashes($faqItem['question']) }}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{ addslashes(strip_tags($faqItem['answer'])) }}"
            }
        }{{ !$loop->last ? ',' : '' }}
        @endforeach
    ]
}
</script>
@endif
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="detail-content">
            @include('partials.breadcrumb', ['crumbs' => $crumbs ?? []])

            <article id="item-detail">
                <header class="article-header">
                    <h1>{!! $blog->h1 !!}</h1>
                    <div class="article-meta">
                        <span class="date">
                            {{ \App\Models\MaterielTask::detailPublished(app()->getLocale()) }}
                            {{ $blog->published_at ? $blog->published_at->format('d F Y') : '' }}
                        </span>
                        @if($blog->author)
                        <span class="author">
                            {{ \App\Models\MaterielTask::by(app()->getLocale()) }} {{ $blog->author }}
                        </span>
                        @endif
                        @if($blog->category_name)
                        <span class="category-label">
                            {{ \App\Models\MaterielTask::filedUnder(app()->getLocale()) }}
                            @if($blog->category)
                            <a href="{{ $blog->category->url }}">{{ $blog->category_name }}</a>
                            @else
                            {{ $blog->category_name }}
                            @endif
                        </span>
                        @endif
                    </div>
                </header>

                <div class="article-body">
                    {!! $blog->content !!}
                </div>

                @if($blog->faq && count($blog->faq) > 0)
                <section class="faq-section">
                    <h2>{{ \App\Models\MaterielTask::detail_content(app()->getLocale()) }}</h2>
                    @foreach($blog->faq as $faqItem)
                    <div class="faq-item">
                        <h3>{{ $faqItem['question'] }}</h3>
                        <div class="faq-answer">{!! $faqItem['answer'] !!}</div>
                    </div>
                    @endforeach
                </section>
                @endif
            </article>
        </div>

        @if(isset($popularBlogs) && $popularBlogs->count())
        <div class="more-items">
            <div class="sidebar-block">
                <div class="sidebar-title">{{ \App\Models\MaterielTask::popular_articles(app()->getLocale()) }}</div>
                @foreach($popularBlogs as $pop)
                <a href="{{ $pop->url }}" class="sidebar-item">
                    @if($pop->head_img)
                    <img src="{{ $pop->head_img }}" alt="{{ $pop->head_img_alt ?: $pop->title }}" loading="lazy" decoding="async">
                    @endif
                    <div class="sidebar-item-title">{{ $pop->title }}</div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        @if(isset($relatedBlogs) && $relatedBlogs->count())
        <div class="related-articles">
            <div class="sidebar-title">{{ \App\Models\MaterielTask::related_posts(app()->getLocale()) }}</div>
            <div class="news-grid">
                @foreach($relatedBlogs as $related)
                @include('partials.newsitem', ['blog' => $related, 'showIntro' => false])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
