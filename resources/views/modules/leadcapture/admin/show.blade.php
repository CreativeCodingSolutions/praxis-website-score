@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="{{ route('leads.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 mb-4">
        <span class="mr-1">←</span> Zurück zur Liste
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Lead Details</h2>
                <dl class="space-y-3">
                    <div class="flex border-b border-gray-100 pb-2">
                        <dt class="w-32 text-sm text-gray-500">Name</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $lead->name }}</dd>
                    </div>
                    <div class="flex border-b border-gray-100 pb-2">
                        <dt class="w-32 text-sm text-gray-500">E-Mail</dt>
                        <dd class="text-sm">
                            <a href="mailto:{{ $lead->email }}" class="text-indigo-600 hover:underline">{{ $lead->email }}</a>
                        </dd>
                    </div>
                    <div class="flex border-b border-gray-100 pb-2">
                        <dt class="w-32 text-sm text-gray-500">Website</dt>
                        <dd class="text-sm">
                            @if($lead->website_url)
                                <a href="{{ $lead->website_url }}" target="_blank" class="text-indigo-600 hover:underline">{{ $lead->website_url }}</a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </dd>
                    </div>
                    <div class="flex border-b border-gray-100 pb-2">
                        <dt class="w-32 text-sm text-gray-500">Score</dt>
                        <dd class="text-sm">
                            @if($lead->score !== null)
                                <span class="px-2 py-1 rounded-full text-xs font-bold {{ $lead->score >= 70 ? 'bg-green-100 text-green-700' : ($lead->score >= 40 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $lead->score }}/100
                                </span>
                            @else
                                <span class="px-2 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500">Noch nicht bewertet</span>
                            @endif
                        </dd>
                    </div>
                    <div class="flex border-b border-gray-100 pb-2">
                        <dt class="w-32 text-sm text-gray-500">Status</dt>
                        <dd class="text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700">{{ $lead->status }}</span>
                        </dd>
                    </div>
                    <div class="flex">
                        <dt class="w-32 text-sm text-gray-500">Eingang</dt>
                        <dd class="text-sm text-gray-900">{{ $lead->created_at->format('d.m.Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div>
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-4">Aktionen</h3>
                <div class="space-y-3">
                    <form method="POST" action="{{ route('leads.score', $lead) }}">
                        @csrf
                        <button class="w-full px-4 py-2 text-sm font-medium text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition">
                            🔄 Neu bewerten
                        </button>
                    </form>
                    <form method="POST" action="{{ route('leads.destroy', $lead) }}" onsubmit="return confirm('Lead wirklich löschen?')">
                        @csrf @method('DELETE')
                        <button class="w-full px-4 py-2 text-sm font-medium text-red-600 border border-red-200 rounded-lg hover:bg-red-50 transition">
                            🗑️ Löschen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
