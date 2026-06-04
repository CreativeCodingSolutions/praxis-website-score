@extends('layouts.app')

@section('title', 'Blog | Praxis Website Score — Website-Tipps für Therapeuten')
@section('meta_description', 'Blog über Website-Optimierung, SEO, Online-Marketing und Webdesign für Therapeuten, Ärzte und Dienstleister im Gesundheitswesen.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-2">Blog</h1>
    <p class="text-gray-500 mb-12">Tipps für bessere Websites, mehr Patienten und stärkere Online-Präsenz.</p>
    
    <div class="space-y-8">
        @forelse($posts ?? [] as $post)
        <article class="border-b pb-8">
            <h2 class="text-xl font-semibold mb-2">
                <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-indigo-600">{{ $post->title }}</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">{{ $post->published_at->format('d.m.Y') }}</p>
            <p class="text-gray-600">{{ $post->excerpt }}</p>
        </article>
        @empty
        <p class="text-gray-400">Demnächst verfügbar — wir arbeiten an den ersten Artikeln!</p>
        @endforelse
    </div>
</div>
@endsection
