@extends('layouts.public')

@section('title', $page->title)

@section('navbarTransparent', 'false')
@section('navbarExtra', 'minimal-navbar')

@push('styles')
<link rel="stylesheet" href="{{ theme_asset('css/theme.css') }}">
@endpush

@section('content')
    @foreach($page->content ?? [] as $section)
        @php $type = str_replace('_', '-', $section['type'] ?? 'text-block'); $data = $section['data'] ?? []; @endphp
        @if(view()->exists('public.sections.' . $type))
            @include('public.sections.' . $type, ['data' => $data])
        @endif
    @endforeach
@endsection
