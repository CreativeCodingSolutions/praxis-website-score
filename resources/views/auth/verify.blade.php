@extends('layouts.app')
@section('title', 'Email verifizieren — Praxis Website Score')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <i class="fa-solid fa-envelope-circle-check text-indigo-600 text-5xl mb-4"></i>
            <h1 class="text-3xl font-bold">Email verifizieren</h1>
            <p class="text-gray-500 mt-2">Bitte bestätige deine Email-Adresse</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 mb-4">{{ session('success') }}</div>
            @endif
            <p class="text-gray-600 mb-6">Vor dem Zugang zum Dashboard musst du deine Email-Adresse verifizieren. Prüfe deinen Posteingang auf den Bestätigungslink.</p>
            <p class="text-sm text-gray-500 mb-4">Keine Email erhalten?</p>
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition">Verifizierungslink erneut senden</button>
            </form>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-red-500">Abmelden</button>
            </form>
        </div>
    </div>
</div>
