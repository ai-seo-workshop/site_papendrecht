@extends('layout')

@section('title', $pageInfo->seo_title ?? $pageInfo->h1)
@section('description', $pageInfo->seo_desc ?? '')

@section('header_extra')
@if(isset($crumbs) && count($crumbs) > 1)
@include('partials.breadcrumb', ['crumbs' => $crumbs])
@endif
@endsection

@section('content')
<div class="container py-5">
    <div class="static-page-content">
        <h1>{{ $pageInfo->h1 }}</h1>
        <div class="page-body">
            {!! $pageInfo->content !!}
        </div>
    </div>
</div>
@endsection
