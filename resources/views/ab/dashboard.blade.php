@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">A/B Test Dashboard — Sommer-Schwung 2026</h1>
    <div class="bg-white border rounded-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left">Variant</th>
                    <th class="px-4 py-3 text-center">Page Views</th>
                    <th class="px-4 py-3 text-center">CTA Clicks</th>
                    <th class="px-4 py-3 text-center">Conversions</th>
                    <th class="px-4 py-3 text-center">CTR</th>
                    <th class="px-4 py-3 text-center">CVR</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats as $stat)
                <tr class="border-t">
                    <td class="px-4 py-3 font-medium">{{ $stat['variant'] }}</td>
                    <td class="px-4 py-3 text-center">{{ $stat['page_views'] }}</td>
                    <td class="px-4 py-3 text-center">{{ $stat['cta_clicks'] }}</td>
                    <td class="px-4 py-3 text-center">{{ $stat['conversions'] }}</td>
                    <td class="px-4 py-3 text-center">{{ $stat['ctr'] }}%</td>
                    <td class="px-4 py-3 text-center">{{ $stat['cvr'] }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p class="text-xs text-gray-500 mt-4">Test: pws_sommer_schwung_2026 | Logging to storage/logs/ab_test_*.jsonl</p>
</div>
@endsection
