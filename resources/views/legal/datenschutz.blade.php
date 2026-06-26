@extends('layouts.app')

@section('title', 'Datenschutzerklärung | Praxis Website Score')
@section('meta_description', 'Datenschutzerklärung von Praxis Website Score — Informationen zum Umgang mit personenbezogenen Daten. DSGVO-konform.')
@section('meta_keywords', 'Datenschutz, DSGVO, Praxis Website Score, Datenschutzerklärung')
@section('canonical', 'https://praxiswebsitescore.creativecoding.cloud/datenschutz')
@section('meta_robots', 'noindex, follow')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-8">Datenschutzerklärung</h1>
    
    <div class="prose prose-gray max-w-none space-y-6">
        <h2 class="text-xl font-semibold mt-8 mb-4">1. Verantwortlicher</h2>
        <p>
            Verantwortlich für die Datenbearbeitung auf dieser Website ist:<br>
            {{ env('COMPANY_OWNER', 'Karsten Brauner') }}, {{ env('COMPANY_NAME', 'CreativeCoding Solutions eG') }}, {{ env('COMPANY_STREET', 'Musterstraße 123') }}, {{ env('COMPANY_ZIP', '1010 Wien') }}, {{ env('COMPANY_COUNTRY', 'Österreich') }}<br>
            E-Mail: {{ env('COMPANY_EMAIL', 'info@creativecoding.cloud') }}
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
            Personenbezogene Daten werden nur so lange aufbewahrt, wie es für die Erfüllung der Zwecke erforderlich ist.
            Konkrete Aufbewahrungsfristen:
        </p>
        <ul class="list-disc pl-6 space-y-1">
            <li><strong>Registrierungsdaten:</strong> Bis zum Widerruf bzw. Löschung des Kontos, spätestens 3 Jahre nach letzter Aktivität.</li>
            <li><strong>Analyse-Ergebnisse:</strong> 90 Tage nach der jeweiligen Analyse, danach automatische Löschung.</li>
            <li><strong>Logfiles (IP-Adressen):</strong> 14 Tage, danach werden IP-Adressen anonymisiert oder gelöscht.</li>
            <li><strong>Cookie-Consent-Einstellungen:</strong> 12 Monate, danach wird erneut abgefragt.</li>
        </ul>
        <p>
            Nach Ablauf der Aufbewahrungsfristen werden die Daten automatisch gelöscht, sofern keine gesetzlichen Aufbewahrungspflichten
            (z.B. steuerrechtliche Aufbewahrung von 7 Jahren für Buchungsdaten) entgegenstehen.
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

        <h2 class="text-xl font-semibold mt-8 mb-4">8. Online-Streitbeilegung (ODR)</h2>
        <p>
            Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (ODR) bereit:<br>
            <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener noreferrer" class="text-blue-600 underline">https://ec.europa.eu/consumers/odr</a>
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">9. Kontakt</h2>
        <p>
            Bei Fragen zum Datenschutz kontaktieren Sie uns unter:<br>
            E-Mail: {{ env('COMPANY_EMAIL', 'info@creativecoding.cloud') }}
        </p>

        <p class="text-sm text-gray-400 mt-8">Stand: Juni 2026</p>
    </div>
</div>
@endsection
