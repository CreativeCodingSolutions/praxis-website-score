@extends('layouts.app')
@section('title', 'Passwort zurücksetzen — Praxis Website Score')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <i class="fa-solid fa-gauge-high text-indigo-600 text-5xl mb-4"></i>
            <h1 class="text-3xl font-bold">Passwort zurücksetzen</h1>
            <p class="text-gray-500 mt-2">Gib ein neues Passwort ein.</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 mb-4">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ $email ?? old('email') }}" required readonly class="w-full px-4 py-2.5 border rounded-lg bg-gray-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Neues Passwort</label>
                    <input type="password" name="password" required minlength="8" class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Passwort bestätigen</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition">Passwort zurücksetzen</button>
            </form>
        </div>
    </div>
</div>
