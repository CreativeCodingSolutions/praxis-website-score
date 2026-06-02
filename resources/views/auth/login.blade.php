@extends('layouts.app')
@section('title', 'Login — Praxis Website Score')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <i class="fa-solid fa-gauge-high text-indigo-600 text-5xl mb-4"></i>
            <h1 class="text-3xl font-bold">Praxis Website Score</h1>
            <p class="text-gray-500 mt-2">Melde dich an</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Passwort</label>
                    <input type="password" name="password" required class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition">Anmelden</button>
            </form>
            <p class="text-center text-sm text-gray-500 mt-6">Noch kein Konto? <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">Registrieren</a></p>
        </div>
    </div>
</div>
