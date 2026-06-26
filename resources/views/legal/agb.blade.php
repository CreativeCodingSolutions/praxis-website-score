@extends('layouts.app')

@section('title', 'AGB | Praxis Website Score')
@section('meta_description', 'Allgemeine Geschäftsbedingungen von Praxis Website Score — Nutzungsbedingungen für den kostenlosen Website-Check.')
@section('meta_keywords', 'AGB, Nutzungsbedingungen, Praxis Website Score, Website Check')
@section('canonical', 'https://praxiswebsitescore.creativecoding.cloud/agb')
@section('meta_robots', 'noindex, follow')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-8">Allgemeine Geschäftsbedingungen</h1>
    
    <div class="prose prose-gray max-w-none space-y-6">
        <h2 class="text-xl font-semibold mt-8 mb-4">1. Geltungsbereich</h2>
        <p>
            Diese AGB gelten für die Nutzung des Dienstes "Praxis Website Score" (nachfolgend "Dienst"),
            bereitgestellt von {{ env('COMPANY_NAME', 'CreativeCoding Solutions eG') }}, {{ env('COMPANY_STREET', 'Musterstraße 123') }}, {{ env('COMPANY_ZIP', '1010 Wien') }}, {{ env('COMPANY_COUNTRY', 'Österreich') }}.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">2. Vertragsgegenstand</h2>
        <p>
            Der Dienst ermöglicht die automatisierte Analyse von Websites und die Erstellung von PDF-Reports.
            Die kostenlose Nutzung ist ohne Verpflichtung mölich.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">3. Registrierung</h2>
        <p>
            Für die Nutzung bestimmter Funktionen ist eine Registrierung erforderlich.
            Der Nutzer verpflichtet sich, wahrheitsgemäße Angaben zu machen.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">4. Preise und Zahlung</h2>
        <p>
            Die Preise sind auf der Preise-Seite einsehbar. Zahlungen erfolgen über Stripe.
            Preise können sich ändern; Änderungen werden mindestens 30 Tage vorher angekündigt.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">5. Widerrufsrecht</h2>
        <p>
            Verbraucher haben das Recht, binnen vierzehn Tagen ab Vertragsschluss den Vertrag zu widerrufen,
            ohne Angabe von Gründen. Um das Widerrufsrecht auszuüben, müssen Sie uns ({{ env('COMPANY_NAME', 'CreativeCoding Solutions eG') }},
            {{ env('COMPANY_STREET', 'Musterstraße 123') }}, {{ env('COMPANY_ZIP', '1010 Wien') }},
            E-Mail: {{ env('COMPANY_EMAIL', 'info@creativecoding.cloud') }}) mittels einer eindeutigen Erklärung
            über Ihre Entscheidung, diesen Vertrag zu widerrufen, informieren.
            Das Widerrufsformular auf der EU-Website kann dafür genutzt werden:
            <a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener">https://ec.europa.eu/consumers/odr/</a>.
        </p>
        <p class="mt-2">
            Das Widerrufsrecht erlischt vorzeitig, wenn wir unsere Dienstleistung vollständig erbracht haben
            und mit der Ausführung erst begonnen haben, nachdem Sie Ihrer Zustimmung ausdrücklich zugestimmt
            und zur Kenntnis genommen haben, dass Sie Ihr Widerrufsrecht bei vollständiger Vertragserfüllung verlieren.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">6. Kündigung</h2>
        <p>
            Der Nutzer kann sein Konto jederzeit über die Einstellungen löschen.
            Das Recht zur fristlosen Kündigung aus wichtigem Grund bleibt unberührt.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">7. Haftung</h2>
        <p>
            Der Dienst wird "wie besehen" bereitgestellt. Eine Garantie für die Richtigkeit
            der Analyseergebnisse wird nicht übernommen. Die Haftung ist auf Vorsatz und grobe Fahrlässigkeit beschränkt.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">8. Änderungen der AGB</h2>
        <p>
            Wir behalten uns das Recht vor, diese AGB zu ändern. Über wesentliche Änderungen
            werden wir per E-Mail informieren.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">9. Anwendbares Recht</h2>
        <p>
            Es gilt österreichisches Recht. Gerichtsstand ist Wien.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">10. Kontakt</h2>
        <p>
            {{ env('COMPANY_NAME', 'CreativeCoding Solutions eG') }}<br>
            {{ env('COMPANY_OWNER', 'Karsten Brauner') }}<br>
            {{ env('COMPANY_STREET', 'Musterstraße 123') }}, {{ env('COMPANY_ZIP', '1010 Wien') }}<br>
            E-Mail: {{ env('COMPANY_EMAIL', 'info@creativecoding.cloud') }}
        </p>

        <p class="text-sm text-gray-400 mt-8">Stand: Juni 2026</p>
    </div>
</div>
@endsection
