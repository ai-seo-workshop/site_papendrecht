@if(isset($crumbs) && count($crumbs) > 1)
<div id="breadcrumbs">
    <div class="container">
        <nav aria-label="Breadcrumb">
            <ol>
                @foreach($crumbs as $crumb)
                <li>
                    @if(!$loop->last)
                    <a href="{{ $crumb['absolute_url'] }}">{{ $crumb['title'] }}</a>
                    @else
                    <span>{{ $crumb['title'] }}</span>
                    @endif
                </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
@endif
