@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            📋 Leads
            <span class="text-base font-normal text-gray-500">({{ $stats['total'] }} gesamt)</span>
        </h1>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Gesamt</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Diese Woche</p>
            <p class="text-3xl font-bold text-green-600">{{ $stats['this_week'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Neu</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $stats['new'] }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Leads Table -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-4 py-3 font-medium text-gray-700">Name</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-700">E-Mail</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-700">Website</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-700">Score</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-700">Status</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-700">Eingang</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-700">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($leads as $lead)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $lead->name }}</td>
                        <td class="px-4 py-3">
                            <a href="mailto:{{ $lead->email }}" class="text-indigo-600 hover:underline">{{ $lead->email }}</a>
                        </td>
                        <td class="px-4 py-3">
                            @if($lead->website_url)
                                <a href="{{ $lead->website_url }}" target="_blank" class="text-indigo-600 hover:underline">{{ Str::limit($lead->website_url, 30) }}</a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($lead->score !== null)
                                <span class="px-2 py-1 rounded-full text-xs font-bold {{ $lead->score >= 70 ? 'bg-green-100 text-green-700' : ($lead->score >= 40 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $lead->score }}/100
                                </span>
                            @else
                                <span class="px-2 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-bold {{ $lead->status === 'new' ? 'bg-blue-100 text-blue-700' : 'bg-indigo-100 text-indigo-700' }}">
                                {{ $lead->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $lead->created_at->format('d.m.Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('leads.show', $lead) }}" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">Details</a>
                                <form method="POST" action="{{ route('leads.destroy', $lead) }}" class="inline" onsubmit="return confirm('Lead wirklich löschen?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-400 hover:text-red-600 text-xs font-medium">Löschen</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-400 py-8">Noch keine Leads vorhanden.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $leads->links() }}</div>
</div>
@endsection
