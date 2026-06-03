@extends('layouts.app')
@section('title', 'White-Label Vorschau — Praxis Website Score')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold">White-Label Vorschau</h1>
            <p class="text-gray-500">So sieht dein Report mit den White-Label-Einstellungen aus.</p>
        </div>
        <a href="{{ route('whitelabel.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700">
            <i class="fa-solid fa-arrow-left mr-2"></i>Zurück
        </a>
    </div>

    <!-- Preview Card -->
    <div class="rounded-xl shadow-sm border overflow-hidden" style="border-color: {{ $settings->primary_color ?? '#4f46e5' }}">
        <div class="p-6 text-white" style="background-color: {{ $settings->primary_color ?? '#4f46e5' }}">
            @if(!empty($settings->logo_path))
                <img src="/storage/{{ $settings->logo_path }}" alt="Logo" class="h-10 mb-3">
            @endif
            <h2 class="text-2xl font-bold">{{ $settings->brand_name ?? 'Praxis Website Score' }}</h2>
            <p class="opacity-80 text-sm mt-1">Website Analyse Report</p>
        </div>
        <div class="p-6 bg-white">
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <p class="text-3xl font-bold" style="color: {{ $settings->primary_color ?? '#4f46e5' }}">87</p>
                    <p class="text-xs text-gray-500 mt-1">Overall Score</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <p class="text-3xl font-bold" style="color: {{ $settings->accent_color ?? '#818cf8' }}">92</p>
                    <p class="text-xs text-gray-500 mt-1">SEO Score</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <p class="text-3xl font-bold" style="color: {{ $settings->primary_color ?? '#4f46e5' }}">78</p>
                    <p class="text-xs text-gray-500 mt-1">Performance</p>
                </div>
            </div>
            <div class="border-t pt-4">
                <p class="text-sm text-gray-500">
                    <i class="fa-solid fa-globe mr-1"></i> beispiel-praxis.de
                </p>
                <p class="text-sm text-gray-500">
                    <i class="fa-solid fa-industry mr-1"></i> Psychotherapie
                </p>
            </div>
            <div class="mt-6 pt-4 border-t text-center text-sm text-gray-400">
                <p>Generiert von {{ $settings->brand_name ?? 'Praxis Website Score' }}</p>
                @if(!empty($settings->custom_domain))
                    <p class="text-xs mt-1">{{ $settings->custom_domain }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
