@extends('layouts.app')

@section('title', 'Review Collector')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                <i class="fa-solid fa-star text-yellow-500 mr-2"></i>Review Collector
            </h1>
            <p class="text-gray-500 mt-1">Generiere Review-Links und verwalte Bewertungen deiner Patienten.</p>
        </div>
        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
            <i class="fa-solid fa-check-circle mr-1"></i>Aktiv
        </span>
    </div>

    <!-- Session Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl">
            <i class="fa-solid fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i>{{ session('error') }}
        </div>
    @endif

    <!-- Review Link Card -->
    <div class="bg-white rounded-2xl border shadow-sm p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">
            <i class="fa-solid fa-link text-indigo-600 mr-2"></i>Dein Review-Link
        </h2>
        <p class="text-sm text-gray-500 mb-4">Teile diesen Link mit deinen Patienten, damit sie direkt eine Bewertung abgeben können.</p>

        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border">
            <input type="text" id="reviewLink" value="{{ $reviewLink }}" readonly
                   class="flex-1 bg-transparent text-sm font-mono text-gray-700 outline-none px-2 py-1">
            <button onclick="navigator.clipboard.writeText(document.getElementById('reviewLink').value)"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                <i class="fa-solid fa-copy mr-1"></i>Kopieren
            </button>
        </div>

        <form action="{{ route('review-collector.generate-link') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                <i class="fa-solid fa-rotate mr-1"></i>Neuen Link generieren
            </button>
        </form>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl border p-5">
            <div class="text-3xl font-bold text-indigo-600">{{ count($reviews) }}</div>
            <div class="text-sm text-gray-500 mt-1">Gesamt Bewertungen</div>
        </div>
        <div class="bg-white rounded-xl border p-5">
            <div class="text-3xl font-bold text-green-600">
                {{ collect($reviews)->where('response', '!=', null)->count() }}
            </div>
            <div class="text-sm text-gray-500 mt-1">Beantwortet</div>
        </div>
        <div class="bg-white rounded-xl border p-5">
            <div class="text-3xl font-bold text-yellow-500">
                {{ collect($reviews)->avg('rating') ? round(collect($reviews)->avg('rating'), 1) : '—' }}
            </div>
            <div class="text-sm text-gray-500 mt-1">Ø Bewertung</div>
        </div>
    </div>

    <!-- Reviews List -->
    <div class="bg-white rounded-2xl border shadow-sm">
        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold">
                <i class="fa-solid fa-list text-indigo-600 mr-2"></i>Eingegangene Bewertungen
            </h2>
        </div>

        @if(count($reviews) === 0)
            <div class="p-12 text-center">
                <div class="text-5xl mb-4">⭐</div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Noch keine Bewertungen</h3>
                <p class="text-gray-400 text-sm">Teile deinen Review-Link mit deinen Patienten, um Bewertungen zu sammeln.</p>
            </div>
        @else
            <div class="divide-y">
                @foreach($reviews as $index => $review)
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <div class="font-semibold text-gray-900">{{ $review['author'] ?? 'Anonym' }}</div>
                                <div class="text-xs text-gray-400">{{ $review['created_at'] ?? 'Unbekannt' }}</div>
                            </div>
                            <div class="flex items-center gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star text-sm {{ $i <= ($review['rating'] ?? 0) ? 'text-yellow-400' : 'text-gray-200' }}"></i>
                                @endfor
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm mb-3">{{ $review['comment'] ?? '' }}</p>

                        @if(!empty($review['response']))
                            <div class="bg-indigo-50 rounded-lg p-3 mt-2">
                                <div class="text-xs font-semibold text-indigo-600 mb-1">
                                    <i class="fa-solid fa-reply mr-1"></i>Deine Antwort ({{ $review['responded_at'] ?? '' }})
                                </div>
                                <p class="text-sm text-gray-700">{{ $review['response'] }}</p>
                            </div>
                        @else
                            <form action="{{ route('review-collector.submit-response', $index) }}" method="POST" class="mt-2">
                                @csrf
                                <textarea name="response" rows="2" placeholder="Auf diese Bewertung antworten..."
                                          class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none"></textarea>
                                <button type="submit" class="mt-2 px-4 py-1.5 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                                    Antworten
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('review-collector.destroy', $index) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-400 hover:text-red-600">
                                <i class="fa-solid fa-trash mr-1"></i>Löschen
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
