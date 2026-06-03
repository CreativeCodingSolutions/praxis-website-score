@extends('layouts.app')
@section('title', 'White-Label — Praxis Website Score')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold">White-Label Einstellungen</h1>
            <p class="text-gray-500">Passe Branding, Domain und E-Mail an dein Corporate Design an.</p>
        </div>
        <a href="{{ route('whitelabel.preview') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">
            <i class="fa-solid fa-eye mr-2"></i>Vorschau
        </a>
    </div>

    <!-- Branding -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-palette text-indigo-500 mr-2"></i>Branding</h2>
        <form action="{{ route('whitelabel.settings') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Markenname</label>
                    <input type="text" name="brand_name" value="{{ $settings->brand_name ?? '' }}" placeholder="Deine Praxis GmbH" class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Eigene Domain</label>
                    <input type="text" name="custom_domain" value="{{ $settings->custom_domain ?? '' }}" placeholder="score.deine-praxis.de" class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Primärfarbe</label>
                    <div class="flex gap-2 items-center">
                        <input type="color" name="primary_color" value="{{ $settings->primary_color ?? '#4f46e5' }}" class="w-12 h-10 rounded border cursor-pointer">
                        <input type="text" value="{{ $settings->primary_color ?? '#4f46e5' }}" readonly class="flex-1 px-4 py-2.5 border rounded-lg bg-gray-50 text-sm font-mono">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Akzentfarbe</label>
                    <div class="flex gap-2 items-center">
                        <input type="color" name="accent_color" value="{{ $settings->accent_color ?? '#818cf8' }}" class="w-12 h-10 rounded border cursor-pointer">
                        <input type="text" value="{{ $settings->accent_color ?? '#818cf8' }}" readonly class="flex-1 px-4 py-2.5 border rounded-lg bg-gray-50 text-sm font-mono">
                    </div>
                </div>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition">
                <i class="fa-solid fa-save mr-2"></i>Einstellungen speichern
            </button>
        </form>
    </div>

    <!-- Logo Upload -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-image text-indigo-500 mr-2"></i>Logo</h2>
        @if(!empty($settings->logo_path))
            <div class="mb-4 p-4 bg-gray-50 rounded-lg inline-block">
                <img src="/storage/{{ $settings->logo_path }}" alt="Logo" class="max-h-16">
                <p class="text-xs text-gray-400 mt-1">Aktuelles Logo</p>
            </div>
        @endif
        <form action="{{ route('whitelabel.logo') }}" method="POST" enctype="multipart/form-data" class="flex gap-3 items-end">
            @csrf
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Logo hochladen (PNG, JPG, SVG)</label>
                <input type="file" name="logo" accept="image/png,image/jpeg,image/svg+xml" class="w-full px-4 py-2.5 border rounded-lg">
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-indigo-700">
                <i class="fa-solid fa-upload mr-2"></i>Hochladen
            </button>
        </form>
    </div>

    <!-- Email Settings -->
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-envelope text-indigo-500 mr-2"></i>E-Mail Einstellungen</h2>
        <form action="{{ route('whitelabel.settings') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Absender-E-Mail</label>
                    <input type="email" name="email_from" value="{{ $settings->email_from ?? '' }}" placeholder="reports@deine-praxis.de" class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reply-To E-Mail</label>
                    <input type="email" name="email_reply_to" value="{{ $settings->email_reply_to ?? '' }}" placeholder="kontakt@deine-praxis.de" class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                </div>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition">
                <i class="fa-solid fa-save mr-2"></i>E-Mail speichern
            </button>
        </form>
    </div>
</div>
@endsection
