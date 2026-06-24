@extends('layouts.app')
@section('title', 'Registrieren — Praxis Website Score')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <i class="fa-solid fa-gauge-high text-indigo-600 text-5xl mb-4"></i>
            <h1 class="text-3xl font-bold">Konto erstellen</h1>
            <p class="text-gray-500 mt-2">Starte kostenlos mit deiner ersten Analyse</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Passwort</label>
                    <input type="password" name="password" required minlength="8" class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Passwort bestätigen</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="flex items-start gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="agb_consent" required class="mt-0.5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span>Ich habe die <a href="/agb" class="text-indigo-600 hover:underline">AGB</a> gelesen und stimme ihnen zu.</span>
                    </label>
                    <label class="flex items-start gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="privacy_consent" required class="mt-0.5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span>Ich habe die <a href="/datenschutz" class="text-indigo-600 hover:underline">Datenschutzerklärung</a> gelesen und stimme der Verarbeitung meiner Daten zu.</span>
                    </label>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition">Registrieren</button>
            </form>
            <p class="text-center text-sm text-gray-500 mt-6">Bereits registriert? <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline">Anmelden</a></p>
        </div>
    </div>
</div>
