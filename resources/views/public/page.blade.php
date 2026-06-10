@extends('layouts.public')

@section('title', $page->title)

@section('navbarTransparent', $page->slug === 'home' ? 'true' : 'false')
@section('navbarExtra', $page->slug === 'home' ? 'navbar-transparent' : 'navbar-solid')

@section('content')
    @foreach($page->content ?? [] as $section)
        @php $type = str_replace('_', '-', $section['type'] ?? 'text-block'); $data = $section['data'] ?? []; @endphp
        @if(view()->exists('public.sections.' . $type))
            @include('public.sections.' . $type, ['data' => $data])
        @endif
    @endforeach
@endsection
