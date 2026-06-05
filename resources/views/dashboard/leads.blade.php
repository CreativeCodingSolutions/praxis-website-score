@extends('layouts.app')
@section('title', 'Leads — Praxis Website Score')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Leads</h1>
            <p class="text-sm text-gray-500 mt-1">Übersicht aller erfassten Leads aus dem Gast-Score</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-700">
                {{ $stats['total'] }} gesamt
            </span>
            <span class="px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                {{ $stats['this_week'] }} diese Woche
            </span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-5 shadow-sm border">
            <p class="text-sm text-gray-500">Gesamt Leads</p>
            <p class="text-2xl font-bold">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border">
            <p class="text-sm text-gray-500">Diese Woche</p>
            <p class="text-2xl font-bold text-green-600">{{ $stats['this_week'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border">
            <p class="text-sm text-gray-500">Mit Website-Score</p>
            <p class="text-2xl font-bold text-indigo-600">{{ $stats['with_report'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border">
            <p class="text-sm text-gray-500">Ø Website-Score</p>
            <p class="text-2xl font-bold text-yellow-600">{{ round($stats['avg_score']) }}</p>
        </div>
    </div>

    <!-- Leads Table -->
    <div class="bg-white rounded-xl shadow-sm border">
        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold">Alle Leads</h2>
        </div>

        @if($leads->isEmpty())
            <div class="p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-inbox text-gray-400 text-2xl"></i>
                </div>
                <p class="text-gray-500 mb-2">Noch keine Leads vorhanden</p>
                <p class="text-sm text-gray-400">Leads werden erfasst, wenn Besucher ihren Website-Score anfordern.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b bg-gray-50">
                            <th class="px-6 py-3 font-medium">Name / Email</th>
                            <th class="px-6 py-3 font-medium">Website</th>
                            <th class="px-6 py-3 font-medium">Score</th>
                            <th class="px-6 py-3 font-medium">Quelle</th>
                            <th class="px-6 py-3 font-medium">Datum</th>
                            <th class="px-6 py-3 font-medium text-right">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leads as $lead)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $lead->name ?? '—' }}</p>
                                <p class="text-xs text-gray-500">{{ $lead->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($lead->guestReport)
                                    <a href="{{ route('dashboard.report', $lead->guestReport) }}" class="text-indigo-600 hover:underline text-xs">
                                        {{ $lead->guestReport->domain }}
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($lead->guestReport)
                                    @php $score = $lead->guestReport->overall_score; @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-bold
                                        {{ $score >= 80 ? 'bg-green-100 text-green-700' : ($score >= 50 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $score }}/100
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs bg-gray-100 text-gray-600">
                                    {{ $lead->source ?? 'guest_score' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                {{ $lead->created_at->format('d.m.Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('dashboard.leads.delete', $lead->id) }}" method="POST" class="inline" onsubmit="return confirm('Lead wirklich löschen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 text-xs">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t">
                {{ $leads->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
