@extends('layouts.app')
@section('title', 'Email verifizieren — Praxis Website Score')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Email verifizieren</h1>
            <p class="text-gray-500 mt-2">Bitte bestätigen Sie Ihre Email-Adresse</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-8 text-center">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 mb-4 text-sm">{{ session('success') }}</div>
            @endif

            <p class="text-gray-600 mb-6 text-sm">
                Wir haben Ihnen einen Verifizierungslink an <strong>{{ $lead->email }}</strong> gesendet.
                Prüfen Sie Ihren Posteingang und klicken Sie auf den Link, um Ihren Report freizuschalten.
            </p>

            <p class="text-sm text-gray-500 mb-4">Keine Email erhalten?</p>

            <form method="POST" action="{{ route('lead.verification.resend') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $lead->email }}">
                <button type="submit" class="w-full bg-gray-900 text-white py-2.5 rounded font-medium hover:bg-gray-800 transition text-sm">
                    Verifizierungslink erneut senden
                </button>
            </form>

            <a href="{{ route('landing') }}" class="block mt-4 text-sm text-gray-500 hover:text-gray-700">
                Zurück zur Startseite
            </a>
        </div>
    </div>
</div>
@endsection
