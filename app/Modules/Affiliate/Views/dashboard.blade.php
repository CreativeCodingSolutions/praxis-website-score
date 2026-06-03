@extends('layouts.app')
@section('title', 'Affiliate Dashboard — Praxis Website Score')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold">Affiliate Dashboard</h1>
            <p class="text-gray-500">Verdiene Provisionen mit deinem Empfehlungslink.</p>
        </div>
        <form method="POST" action="{{ route('affiliate.generate') }}">@csrf
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">Neuen Code generieren</button>
        </form>
    </div>

    <!-- Referral Link -->
    <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-6 mb-8">
        <p class="text-sm text-indigo-600 font-medium mb-2">Dein Affiliate-Code</p>
        <div class="flex items-center gap-3">
            <code class="bg-white px-4 py-2 rounded-lg font-mono text-lg font-bold text-indigo-700 border">{{ $referralCode }}</code>
            <span class="text-sm text-indigo-40">{{ url('/register') }}?ref={{ $referralCode }}</span>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Empfehlungen</p>
            <p class="text-3xl font-bold">{{ $stats['referrals'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Klicks</p>
            <p class="text-3xl font-bold">{{ $stats['clicks'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Konversionen</p>
            <p class="text-3xl font-bold">{{ $stats['conversions'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <p class="text-sm text-gray-500">Verdienst</p>
            <p class="text-3xl font-bold">€{{ $stats['earnings'] }}</p>
        </div>
    </div>
</div>
@endsection
