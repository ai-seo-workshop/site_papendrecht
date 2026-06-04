{{-- Reusable article card: .item-big --}}
@php $showIntro = $showIntro ?? true; @endphp

<div class="item-big {{ !$showIntro ? 'without-intro' : '' }}">
    <a href="{{ $blog->url }}" class="item-big-inner" tabindex="-1" aria-hidden="true"></a>
    @if($blog->head_img)
    <div class="item-image" style="background-image: url('{{ $blog->head_img }}');" role="img" aria-label="{{ $blog->head_img_alt ?: $blog->title }}">
        <img src="{{ $blog->head_img }}" alt="{{ $blog->head_img_alt ?: $blog->title }}" loading="lazy" decoding="async" class="visually-hidden">
    </div>
    @else
    <div class="item-image item-image--placeholder" role="img" aria-label="{{ $blog->title }}"></div>
    @endif

    @if($blog->published_at)
    <div class="item-date">
        <span>{{ $blog->published_at->format('d') }}</span>
        {{ $blog->published_at->format('M') }}
    </div>
    @endif

    <div class="info">
        <div class="title">
            <a href="{{ $blog->url }}">{{ $blog->title }}</a>
        </div>
        @if($showIntro && $blog->summary)
        <div class="intro">{{ Str::limit($blog->summary, 120) }}</div>
        @endif
    </div>
</div>
