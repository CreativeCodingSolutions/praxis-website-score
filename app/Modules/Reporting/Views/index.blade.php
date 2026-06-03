@extends('layouts.app')
@section('title', 'Reporting — Praxis Website Score')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold">Reporting</h1>
            <p class="text-gray-500">Generiere PDF-Reports deiner Website-Auswertungen.</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Gesamt Reports</p>
            <p class="text-3xl font-bold">{{ $stats['total_reports'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Ø Score</p>
            <p class="text-3xl font-bold">{{ $stats['avg_score'] }}/100</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Top Score</p>
            <p class="text-3xl font-bold">{{ $stats['top_score'] }}/100</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Letzter Report</p>
            <p class="text-lg font-bold">{{ $stats['last_report']?->domain ?? '—' }}</p>
            @if($stats['last_report'])
                <p class="text-xs text-gray-400">{{ $stats['last_report']->created_at->format('d.m.Y') }}</p>
            @endif
        </div>
    </div>

    <!-- Generate Report -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-file-pdf text-red-500 mr-2"></i>PDF-Report generieren</h2>
        <form action="{{ route('reporting.generate') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="text" name="title" required placeholder="Report-Titel (z.B. Q2 2025 Praxis-Auswertung)" class="flex-1 px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
            <select name="report_type" class="px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                <option value="full">Vollständig</option>
                <option value="single">Einzelauswertung</option>
                <option value="comparative">Vergleichend</option>
            </select>
            <button type="submit" class="bg-red-500 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-red-600 transition">
                <i class="fa-solid fa-file-pdf mr-2"></i>PDF generieren
            </button>
        </form>
        <p class="text-xs text-gray-400 mt-2"><i class="fa-solid fa-info-circle mr-1"></i>PDF wird als HTML-Simulation generiert (kein natives PDF-Rendering).</p>
    </div>

    <!-- Scheduled Reports -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-clock text-indigo-500 mr-2"></i>Automatische Reports</h2>
        @if($scheduledReports->isEmpty())
            <p class="text-gray-400 text-center py-4">Keine automatischen Reports eingerichtet.</p>
        @else
            <div class="space-y-3">
                @foreach($scheduledReports as $scheduled)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium">{{ ucfirst($scheduled->frequency) }} an {{ $scheduled->email }}</p>
                        <p class="text-xs text-gray-400">Erstellt: {{ \Carbon\Carbon::parse($scheduled->created_at)->format('d.m.Y') }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="px-2 py-1 rounded-full text-xs font-bold {{ $scheduled->active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                            {{ $scheduled->active ? 'Aktiv' : 'Inaktiv' }}
                        </span>
                        <form method="POST" action="{{ route('reporting.scheduled.delete', $scheduled->id) }}">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600 text-sm"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('reporting.scheduled.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3 mt-4 pt-4 border-t">
            @csrf
            <select name="frequency" class="px-4 py-2.5 border rounded-lg">
                <option value="daily">Täglich</option>
                <option value="weekly">Wöchentlich</option>
                <option value="monthly">Monatlich</option>
            </select>
            <input type="email" name="email" required placeholder="Empfänger-E-Mail" class="flex-1 px-4 py-2.5 border rounded-lg">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-indigo-700">Einrichten</button>
        </form>
    </div>

    <!-- All Reports Table -->
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="text-lg font-semibold mb-4">Alle Auswertungen</h2>
        @if($reports->isEmpty())
            <p class="text-gray-400 text-center py-8">Noch keine Analysen vorhanden.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="text-left text-gray-500 border-b"><th class="pb-3">Domain</th><th class="pb-3">Score</th><th class="pb-3">Branche</th><th class="pb-3">Datum</th><th class="pb-3"></th></tr></thead>
                    <tbody>
                    @foreach($reports as $r)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 font-medium">{{ $r->domain }}</td>
                        <td class="py-3"><span class="px-2 py-1 rounded-full text-xs font-bold {{ $r->overall_score >= 80 ? 'bg-green-100 text-green-700' : ($r->overall_score >= 60 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">{{ $r->overall_score }}/100</span></td>
                        <td class="py-3 text-gray-600">{{ $r->industry }}</td>
                        <td class="py-3 text-gray-400">{{ $r->created_at->format('d.m.Y') }}</td>
                        <td class="py-3 text-right">
                            <a href="{{ route('dashboard.report', $r) }}" class="text-indigo-600 hover:underline mr-2">Anzeigen</a>
                            <a href="{{ route('dashboard.pdf', $r) }}" class="text-gray-400 hover:text-indigo-600"><i class="fa-solid fa-file-pdf"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $reports->links() }}</div>
        @endif
    </div>
</div>
@endsection
