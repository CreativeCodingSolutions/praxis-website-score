@extends('layouts.app')

@section('title', 'Social Proof')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Social Proof — Testimonials</h1>
        <a href="{{ route('social-proof.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Neues Testimonial
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($testimonials as $testimonial)
        <div class="bg-white rounded-lg shadow p-6 {{ $testimonial['active'] ? '' : 'opacity-50' }}">
            <div class="flex items-center mb-4">
                <div class="flex-1">
                    <h3 class="font-semibold">{{ $testimonial['name'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $testimonial['role'] }}</p>
                </div>
                <div class="flex">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 {{ $i < $testimonial['rating'] ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>
            </div>
            <p class="text-gray-700 italic mb-4">"{{ $testimonial['text'] }}"</p>
            <div class="flex gap-2">
                <form action="{{ route('social-proof.toggle', $testimonial['id']) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="text-sm px-3 py-1 rounded {{ $testimonial['active'] ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                        {{ $testimonial['active'] ? 'Deaktivieren' : 'Aktivieren' }}
                    </button>
                </form>
                <form action="{{ route('social-proof.destroy', $testimonial['id']) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm px-3 py-1 rounded bg-red-100 text-red-800 hover:bg-red-200">
                        Löschen
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-2 text-center text-gray-500 py-12">
            Noch keine Testimonials. Füge das erste hinzu!
        </div>
        @endforelse
    </div>
</div>
@endsection
