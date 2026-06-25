@extends('layouts.app')
@section('title', 'Passwort vergessen — Praxis Website Score')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <i class="fa-solid fa-gauge-high text-indigo-600 text-5xl mb-4"></i>
            <h1 class="text-3xl font-bold">Passwort vergessen?</h1>
            <p class="text-gray-500 mt-2">Gib deine Email ein und erhalte einen Link zum Zurücksetzen.</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8">
            @if(session('status'))
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 mb-4">{{ session('status') }}</div>
            @endif
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 mb-4">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition">Link senden</button>
            </form>
            <p class="text-center text-sm text-gray-500 mt-6">Zurück zum <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline">Login</a></p>
        </div>
    </div>
</div>
