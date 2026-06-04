@extends('layouts.app')

@section('title', 'Datenschutzerklärung | Praxis Website Score')
@section('meta_description', 'Datenschutzerklärung von Praxis Website Score — Informationen zum Umgang mit personenbezogenen Daten.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-8">Datenschutzerklärung</h1>
    
    <div class="prose prose-gray max-w-none space-y-6">
        <h2 class="text-xl font-semibold mt-8 mb-4">1. Verantwortlicher</h2>
        <p>
            Verantwortlich für die Datenbearbeitung auf dieser Website ist:<br>
            Karsten Brauner, Musterstraße 123, 1010 Wien, Österreich<br>
            E-Mail: info@creativecoding.cloud
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">2. Erhebung und Speicherung personenbezogener Daten</h2>
        <p>
            Bei der Registrierung und Nutzung unseres Diensts werden folgende Daten erhoben:
        </p>
        <ul class="list-disc pl-6 space-y-1">
            <li>Name und E-Mail-Adresse (bei Registrierung)</li>
            <li>Website-URL (bei Analyse-Anfragen)</li>
            <li>Nutzungsdaten (Logfiles, IP-Adresse, Zugriffszeiten)</li>
        </ul>

        <h2 class="text-xl font-semibold mt-8 mb-4">3. Zweck der Datenverarbeitung</h2>
        <p>
            Die erhobenen Daten werden ausschließlich für die Bereitstellung unseres Diensts verwendet:
            Durchführung von Website-Analysen, Erstellung von PDF-Reports und Kommunikation mit Nutzern.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">4. Rechtsgrundlage</h2>
        <p>
            Die Datenverarbeitung erfolgt auf Grundlage von Art. 6 Abs. 1 lit. b DSGVO (Vertragserfüllung)
            und Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse).
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">5. Speicherdauer</h2>
        <p>
            Personenbezogene Daten werden gelöscht, sobald der Zweck der Speicherung entfällt.
            Nutzerkonten können jederzeit über die Einstellungen gelöscht werden.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">6. Ihre Rechte</h2>
        <p>
            Sie haben das Recht auf Auskunft, Berichtigung, Löschung, Einschränkung der Verarbeitung,
            Datenübertragbarkeit und Widerspruch. Kontakt: info@creativecoding.cloud
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">7. Hosting</h2>
        <p>
            Diese Website wird auf einem VPS von Hostinger International Ltd. gehostet.
            Es werden keine Daten an Dritte weitergegeben, es sei denn, dies ist gesetzlich vorgeschrieben.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-8">8. Kontakt</h2>
        <p>
            Bei Fragen zum Datenschutz kontaktieren Sie uns unter:<br>
            E-Mail: info@creativecoding.cloud
        </p>

        <p class="text-sm text-gray-400 mt-8">Stand: Juni 2026</p>
    </div>
</div>
@endsection
