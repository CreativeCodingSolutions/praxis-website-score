@extends('layouts.app')
@section('title', 'Report — Praxis Website Score')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">{{ $data['domain'] }}</h1>
            <p class="text-gray-500">{{ $data['crawled_at'] }} · {{ $data['industry'] }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('dashboard.pdf', $report) }}" class="px-4 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-medium hover:bg-red-100">
                <i class="fa-solid fa-file-pdf mr-1"></i>PDF Download
            </a>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">
                <i class="fa-solid fa-plus mr-1"></i>Neue Analyse
            </a>
        </div>
    </div>

    <!-- Overall Score -->
    @php $s = $data['overall_score']; $color = $s >= 80 ? 'green' : ($s >= 60 ? 'yellow' : 'red'); @endphp
    <div class="text-center mb-8 p-8 bg-white rounded-2xl shadow-sm border">
        <div class="text-8xl font-bold text-{{ $color }}-500 mb-2">{{ $s }}</div>
        <div class="text-2xl font-bold text-{{ $color }}-500">von 100 Punkten</div>
        <div class="text-gray-400 mt-2">Gesamtbewertung</div>
    </div>

    <!-- Categories -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        @php $labels = ['performance' => ['⚡', 'Performance'], 'seo' => ['🔍', 'SEO'], 'mobile' => ['📱', 'Mobile-Freundlichkeit'], 'content' => ['📝', 'Content-Qualität'], 'security' => ['🔒', 'Sicherheit'], 'design' => ['🎨', 'Design & Modernität']]; @endphp
        @foreach($data['categories'] as $key => $cat)
        @php $cs = $cat['score']; $cc = $cs >= 80 ? 'green' : ($cs >= 60 ? 'yellow' : 'red'); @endphp
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold">{{ $labels[$key][0] }} {{ $labels[$key][1] }}</h3>
                <span class="text-2xl font-bold text-{{ $cc }}-500">{{ $cs }}</span>
            </div>
            <div class="bg-gray-200 rounded-full h-2 mb-4"><div class="bg-{{ $cc }}-500 h-2 rounded-full" style="width:{{ $cs }}%"></div></div>
            <div class="space-y-1.5">
                @foreach($cat['checks'] ?? [] as $check)
                <div class="text-sm {{ $check[0] === '✓' ? 'text-green-700' : ($check[0] === '✗' ? 'text-red-600' : 'text-yellow-700') }}">
                    {{ $check[0] === '✓' ? '✅' : ($check[0] === '✗' ? '❌' : '⚠️') }} {{ $check[1] }}
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <!-- Recommendations -->
    @if(!empty($data['recommendations']))
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-6">
        <h3 class="font-semibold text-amber-800 mb-3"><i class="fa-solid fa-lightbulb text-amber-500 mr-2"></i>Top Empfehlungen zur Verbesserung</h3>
        <ol class="space-y-2">
            @foreach($data['recommendations'] as $i => $rec)
            <li class="text-sm text-amber-900"><span class="font-bold">{{ $i+1 }}.</span> {{ $rec }}</li>
            @endforeach
        </ol>
    </div>
    @endif
</div>
@endsection
