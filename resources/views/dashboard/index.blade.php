@extends('layouts.app')
@section('title', 'Dashboard — Praxis Website Score')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Reports erstellt</p>
            <p class="text-3xl font-bold">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Ø Score</p>
            <p class="text-3xl font-bold">{{ round($stats['avg_score']) }}/100</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Plan</p>
            <p class="text-lg font-bold capitalize">{{ $stats['user']->plan }} @if($stats['user']->plan === 'free')({{ $stats['user']->reports_used }}/{{ $stats['user']->reports_limit }}) @endif</p>
            @if($stats['user']->plan === 'free')<a href="{{ route('pricing') }}" class="text-sm text-indigo-600 hover:underline">Upgrade →</a>@endif
        </div>
    </div>

    <!-- Module Status -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-cubes text-indigo-600 mr-2"></i>Modul-Status</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach($modules as $module)
            <div class="flex items-center justify-between p-4 rounded-lg border {{ $module['enabled'] ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-gray-200' }}">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $module['enabled'] ? 'bg-green-100 text-green-600' : 'bg-gray-200 text-gray-400' }}">
                        <i class="fa-solid {{ $module['icon'] }}"></i>
                    </div>
                    <div>
                        <p class="font-medium text-sm">{{ $module['name'] }}</p>
                        <p class="text-xs text-gray-400">{{ $module['description'] }}</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $module['enabled'] ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-500' }}">
                    {{ $module['enabled'] ? 'Aktiv' : 'Inaktiv' }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- New Check -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-plus-circle text-indigo-600 mr-2"></i>Neue Website analysieren</h2>
        <form action="{{ route('dashboard.check') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="url" name="url" required placeholder="https://www.praxis-beispiel.de" class="flex-1 px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
            <select name="industry" class="px-4 py-2.5 border rounded-lg">
                <option value="general">Allgemein</option>
                <option value="psychotherapist">Psychotherapie</option>
                <option value="physiotherapist">Physiotherapie</option>
                <option value="doctor">Arzt</option>
                <option value="dentist">Zahnarzt</option>
                <option value="coach">Coach</option>
                <option value="heilpraktiker">Heilpraktiker</option>
            </select>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition">
                <i class="fa-solid fa-bolt mr-2"></i>Analysieren
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Reports Table -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-lg font-semibold mb-4">Letzte Reports</h2>
            @if($reports->isEmpty())
                <p class="text-gray-400 text-center py-8">Noch keine Analysen. Starte deine erste!</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead><tr class="text-left text-gray-500 border-b"><th class="pb-3">Website</th><th class="pb-3">Score</th><th class="pb-3">Branche</th><th class="pb-3">Datum</th><th class="pb-3"></th></tr></thead>
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

        <!-- Letzte Auswertungen Widget -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-clock-rotate-left text-indigo-600 mr-2"></i>Letzte Auswertungen</h2>
            @if($recentEvaluations->isEmpty())
                <p class="text-gray-400 text-center py-8">Noch keine Auswertungen.</p>
            @else
                <div class="space-y-3">
                    @foreach($recentEvaluations as $eval)
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 {{ $eval->overall_score >= 80 ? 'bg-green-100 text-green-600' : ($eval->overall_score >= 60 ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }}">
                            <span class="text-sm font-bold">{{ $eval->overall_score }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-sm truncate">{{ $eval->domain }}</p>
                            <p class="text-xs text-gray-400">{{ $eval->created_at->diffForHumans() }} · {{ $eval->industry }}</p>
                        </div>
                        <a href="{{ route('dashboard.report', $eval) }}" class="text-indigo-600 hover:text-indigo-800 flex-shrink-0">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
            @endif

            <!-- Quick Links -->
            <div class="mt-6 pt-4 border-t">
                <h3 class="text-sm font-semibold text-gray-500 mb-3">Schnellzugriff</h3>
                <div class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-sm text-gray-600 hover:text-indigo-600">
                        <i class="fa-solid fa-gauge-high w-5 text-center"></i> Dashboard
                    </a>
                    @if(\App\Modules\Affiliate\Module::isEnabled())
                    <a href="{{ route('affiliate.dashboard') }}" class="flex items-center gap-2 text-sm text-gray-600 hover:text-indigo-600">
                        <i class="fa-solid fa-handshake w-5 text-center"></i> Affiliate
                    </a>
                    @endif
                    @if(\App\Modules\ApiAccess\Module::isEnabled())
                    <a href="{{ route('apikeys.index') }}" class="flex items-center gap-2 text-sm text-gray-600 hover:text-indigo-600">
                        <i class="fa-solid fa-key w-5 text-center"></i> API Keys
                    </a>
                    @endif
                    @if(\App\Modules\TeamManagement\Module::isEnabled())
                    <a href="{{ route('team.index') }}" class="flex items-center gap-2 text-sm text-gray-600 hover:text-indigo-600">
                        <i class="fa-solid fa-users w-5 text-center"></i> Team
                    </a>
                    @endif
                    @if(\App\Modules\Reporting\Module::isEnabled())
                    <a href="{{ route('reporting.index') }}" class="flex items-center gap-2 text-sm text-gray-600 hover:text-indigo-600">
                        <i class="fa-solid fa-file-pdf w-5 text-center"></i> Reporting
                    </a>
                    @endif
                    @if(\App\Modules\WhiteLabel\Module::isEnabled())
                    <a href="{{ route('whitelabel.index') }}" class="flex items-center gap-2 text-sm text-gray-600 hover:text-indigo-600">
                        <i class="fa-solid fa-palette w-5 text-center"></i> White-Label
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
