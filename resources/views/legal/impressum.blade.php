@extends('layouts.app')

@section('title', 'Impressum | Praxis Website Score')
@section('meta_description', 'Impressum von Praxis Website Score — Automatisierte Website-Analyse für Therapeuten und Praxen. CreativeCoding Solutions eG, Wien.')
@section('meta_keywords', 'Impressum, CreativeCoding Solutions, Praxis Website Score, Kontakt')
@section('canonical', 'https://praxiswebsitescore.creativecoding.cloud/impressum')
@section('meta_robots', 'noindex, follow')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-8">Impressum</h1>
    
    <div class="prose prose-gray max-w-none">
        <p class="text-lg text-gray-600 mb-6">Angaben gemäß § 5 TMG</p>
        
        <p class="mb-4">
            {{ env('COMPANY_NAME', 'CreativeCoding Solutions eG') }}<br>
            {{ env('COMPANY_OWNER', 'Karsten Brauner') }}<br>
            {{ env('COMPANY_STREET', 'Musterstraße 123') }}<br>
            {{ env('COMPANY_ZIP', '1010 Wien') }}<br>
            {{ env('COMPANY_COUNTRY', 'Österreich') }}<br>
            Firmenbuch: {{ env('COMPANY_FIRMENBUCH', '1234567890') }}
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">Kontakt</h2>
        <p class="mb-4">
            E-Mail: info@creativecoding.cloud
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">EU-Streitschlichtung</h2>
        <p class="mb-4">
            Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:
            <a href="https://ec.europa.eu/consumers/odr/" class="text-indigo-600 hover:underline" target="_blank" rel="noopener">
                https://ec.europa.eu/consumers/odr/
            </a>
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">Verantwortlich für den Inhalt</h2>
        <p class="mb-4">
            {{ env('COMPANY_OWNER', 'Karsten Brauner') }}<br>
            {{ env('COMPANY_NAME', 'CreativeCoding Solutions eG') }}<br>
            {{ env('COMPANY_STREET', 'Musterstraße 123') }}<br>
            {{ env('COMPANY_ZIP', '1010 Wien') }}
        </p>
    </div>
</div>
@endsection
