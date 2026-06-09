@extends('layouts.app')
@section('title', 'Preise — Praxis Website Score | Kostenlos & Pro ab €19/Monat')
@section('meta_description', 'Einfache, faire Preise für den Praxis Website Score. Kostenlos starten, Pro-Report ab €19/Monat. Keine versteckten Kosten, monatlich kündbar. DACH-Fokus.')

@section('og_tags')
<meta property="og:title" content="Preise — Praxis Website Score | Kostenlos & Pro ab €19/Monat">
<meta property="og:description" content="Einfache, faire Preise. Kostenlos starten, Pro-Report ab €19/Monat. Keine versteckten Kosten.">
<meta property="og:type" content="website">
@endsection

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Praxis Website Score",
    "description": "Kostenloser Website-Check für Praxen, Handwerker und Restaurants in DACH.",
    "offers": [
        {
            "@type": "Offer",
            "name": "Free",
            "price": "0",
            "priceCurrency": "EUR",
            "description": "Einmaliger Basis-Score, sofortiges Ergebnis, Verbesserungshinweise"
        },
        {
            "@type": "Offer",
            "name": "Pro",
            "price": "19",
            "priceCurrency": "EUR",
            "description": "30 Analysen/Monat, PDF-Reports, Branchenvergleich"
        },
        {
            "@type": "Offer",
            "name": "Business",
            "price": "49",
            "priceCurrency": "EUR",
            "description": "Unbegrenzte Analysen, White-Label PDF, API-Zugang"
        }
    ]
}
</script>
@endsection

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-4">Einfache, faire Preise</h1>
        <p class="text-gray-500 text-lg">Starte kostenlos. 7 Tage Pro kostenlos testen.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
        <!-- Free -->
        <div class="bg-white rounded-2xl shadow-sm border p-8">
            <h3 class="text-lg font-semibold mb-2">Free</h3>
            <div class="text-4xl font-bold mb-1">€0</div>
            <p class="text-gray-400 text-sm mb-6">für immer</p>
            <ul class="space-y-3 mb-8 text-sm">
                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> 1 Website-Analyse</li>
                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Basis-Score</li>
                <li class="flex items-center gap-2 text-gray-400"><i class="fa-solid fa-xmark"></i> Kein PDF-Report</li>
            </ul>
            <a href="/register" class="block text-center py-2.5 border border-gray-300 rounded-lg font-medium hover:bg-gray-50 transition">Kostenlos starten</a>
        </div>

        <!-- Pro -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-indigo-500 p-8 relative">
            <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full">7 Tage kostenlos</div>
            <h3 class="text-lg font-semibold mb-2">Pro</h3>
            <div class="text-4xl font-bold mb-1">€19<span class="text-lg text-gray-400">/mo</span></div>
            <p class="text-gray-400 text-sm mb-6">nach 7-Tage-Test · monatlich kündbar</p>
            <ul class="space-y-3 mb-8 text-sm">
                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> 30 Analysen/Monat</li>
                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> PDF-Reports</li>
                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Branchenvergleich</li>
                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Email-Benachrichtigung</li>
            </ul>
            @auth
            <form action="{{ route('stripe.checkout') }}" method="POST">@csrf<input type="hidden" name="plan" value="pro">
            <button type="submit" class="w-full py-2.5 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">7 Tage kostenlos testen →</button></form>
            @else
            <a href="/register" class="block text-center py-2.5 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">7 Tage kostenlos testen</a>
            @endauth
        </div>

        <!-- Business -->
        <div class="bg-white rounded-2xl shadow-sm border p-8">
            <h3 class="text-lg font-semibold mb-2">Business</h3>
            <div class="text-4xl font-bold mb-1">€49<span class="text-lg text-gray-400">/mo</span></div>
            <p class="text-gray-400 text-sm mb-6">nach 7-Tage-Test · monatlich kündbar</p>
            <ul class="space-y-3 mb-8 text-sm">
                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Unbegrenzte Analysen</li>
                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> White-Label PDF</li>
                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> API-Zugang</li>
                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Prioritäts-Support</li>
            </ul>
            @auth
            <form action="{{ route('stripe.checkout') }}" method="POST">@csrf<input type="hidden" name="plan" value="business">
            <button type="submit" class="w-full py-2.5 border border-gray-300 rounded-lg font-medium hover:bg-gray-50 transition">7 Tage kostenlos testen →</button></form>
            @else
            <a href="/register" class="block text-center py-2.5 border border-gray-300 rounded-lg font-medium hover:bg-gray-50 transition">7 Tage kostenlos testen</a>
            @endauth
        </div>
    </div>

    <!-- Guarantee -->
    <div class="text-center mt-12 p-6 bg-green-50 rounded-xl max-w-2xl mx-auto">
        <i class="fa-solid fa-shield-halved text-green-600 text-2xl mb-3"></i>
        <p class="font-semibold text-green-800">7 Tage kostenlos + 14-Tage Geld-zurück-Garantie</p>
        <p class="text-sm text-green-600 mt-1">Teste Pro 7 Tage kostenlos. Danach zufrieden oder Geld zurück.</p>
    </div>

    <!-- FAQ -->
    <div class="max-w-2xl mx-auto mt-16">
        <h2 class="text-2xl font-bold text-center mb-8">Häufige Fragen</h2>
        <div class="space-y-4">
            @php $faqs = [
                ['Was kostet die 7-Tage-Testphase?', 'Nichts. Du bekommst 7 Tage lang vollen Zugang zu Pro — kostenlos und ohne Verpflichtung. Wenn du nicht kündigst, wird nach 7 Tagen automatisch das bezahlte Abo aktiviert.'],
                ['Wie funktioniert die Analyse?', 'Du gibst eine Website-URL ein, unser System crawlt die Seite und bewertet sie in 6 Kategorien: Performance, SEO, Mobile, Content, Sicherheit und Design.'],
                ['Kann ich jederzeit kündigen?', 'Ja, alle Pläne sind monatlich kündbar. Keine versteckten Kosten.'],
                ['Für wen ist das Tool geeignet?', 'Für Therapeuten, Ärzte, Heilpraktiker, Coaches und andere Dienstleister, die ihre Website optimieren möchten — oder für Agenturen, die Website-Reviews für Kunden erstellen.'],
                ['Ist der Test wirklich kostenlos?', 'Ja. Eine kostenlose Analyse ohne Anmeldung. Für PDF-Reports und mehr Analysen kannst du 7 Tage Pro kostenlos testen.'],
            ]; @endphp
            @foreach($faqs as $faq)
            <div class="bg-white rounded-lg border p-5">
                <h3 class="font-semibold mb-2">{{ $faq[0] }}</h3>
                <p class="text-sm text-gray-600">{{ $faq[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
