<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $hero_headline }} | Praxis Website Score</title>
    <meta name="description" content="{{ $hero_subheadline }} Kostenloser Website-Check für Praxen in DACH.">
    <meta name="robots" content="noindex, follow">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #cookie-banner { display: none; }
        #cookie-banner.show { display: block; }
    </style>
</head>
<body class="bg-white text-gray-800 font-sans">
    <div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-gray-900 text-white p-4 z-[100] shadow-lg">
        <div class="max-w-5xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-300">Wir verwenden keine Cookies und tracken Sie nicht. <a href="/datenschutz" class="underline hover:no-underline text-indigo-400">Datenschutzerklärung</a></p>
            <div class="flex items-center gap-3 shrink-0">
                <button id="cookie-decline-btn" class="bg-gray-700 text-white px-4 py-2 rounded text-sm font-medium hover:bg-gray-600 transition whitespace-nowrap">Nur notwendige</button>
                <button id="cookie-accept-btn" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm font-medium hover:bg-indigo-700 transition whitespace-nowrap">Verstanden</button>
            </div>
        </div>
    </div>
    <nav class="border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-14 items-center">
            <div class="flex items-center gap-2">
                <span class="text-lg font-semibold text-gray-900">Praxis Website Score</span>
                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded">A/B Test</span>
            </div>
            <div class="flex items-center gap-6 text-sm">
                <a href="/" class="text-gray-600 hover:text-gray-900">Zur Standardseite</a>
                <a href="{{ route('pricing') }}" class="text-gray-600 hover:text-gray-900">Preise</a>
                <a href="/login" class="text-gray-600 hover:text-gray-900">Login</a>
                <a href="{{ $cta_url }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-sm font-medium">{{ $cta_text }}</a>
            </div>
        </div>
    </nav>
    <section id="hero-form" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="max-w-2xl">
            <p class="text-sm font-medium text-indigo-600 mb-3">Für Praxen, Handwerker & Restaurants in DACH</p>
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 leading-tight mb-6">{{ $hero_headline }}</h1>
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">{{ $hero_subheadline }}</p>
            <form action="{{ route('guest.score.analyze') }}" method="POST" class="mb-4">
                @csrf
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="url" name="url" required placeholder="Ihre Website-Adresse (z.B. www.muster-praxis.de)" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg text-base focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg text-base font-medium hover:bg-indigo-700 transition">{{ $cta_text }}</button>
                </div>
            </form>
            <p class="text-sm text-gray-500">✓ Kostenlos &nbsp; ✓ Keine Anmeldung &nbsp; ✓ Ergebnis in 30 Sekunden</p>
        </div>
    </section>
    <section class="border-t border-b border-gray-200 py-8 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-8 text-sm text-gray-500">
                <span>✓ DSGVO-konform</span>
                <span>✓ Serverstandort Deutschland</span>
                <span>✓ Kein Tracking</span>
                <span>✓ Keine Kreditkarte nötig</span>
            </div>
        </div>
    </section>
    <section class="bg-white py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Typische Probleme bei lokalen Websites</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="font-semibold text-gray-900 mb-2">Patienten finden Sie nicht bei Google</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Wenn Ihre Praxis nicht auf der ersten Seite bei Google auftaucht, suchen Patienten weiter.</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="font-semibold text-gray-900 mb-2">Die Seite lädt zu langsam</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Jede Sekunde Ladezeit kostet Sie Besucher. Gerade auf dem Handy muss eine Seite in unter 3 Sekunden laden.</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="font-semibold text-gray-900 mb-2">Auf dem Handy sieht alles anders aus</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Buttons zu klein, Text nicht lesbar — viele Praxis-Seiten vernachlässigen die mobile Darstellung.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-indigo-600 py-16">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Bereit für Ihren Website-Check?</h2>
            <p class="text-indigo-100 mb-8">Testen Sie jetzt kostenlos, wie Ihre Website abschneidet. Keine Anmeldung nötig.</p>
            <a href="#hero-form" class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-medium hover:bg-indigo-50 transition">{{ $cta_text }}</a>
        </div>
    </section>
    <footer class="border-t border-gray-200 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <p class="text-sm text-gray-500">© {{ date('Y') }} Praxis Website Score</p>
                <div class="flex gap-6 text-sm text-gray-500">
                    <a href="/datenschutz">Datenschutz</a>
                    <a href="/impressum">Impressum</a>
                    <a href="/agb">AGB</a>
                </div>
            </div>
        </div>
    </footer>
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            fetch('{{ route("ab.track.click") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
        });
        (function() {
            var STORAGE_KEY = 'praxis_cookie_consent';
            var banner = document.getElementById('cookie-banner');
            var existing = localStorage.getItem(STORAGE_KEY);
            if (!existing && banner) { setTimeout(function() { banner.classList.add('show'); }, 1000); }
            var acceptBtn = document.getElementById('cookie-accept-btn');
            if (acceptBtn) { acceptBtn.addEventListener('click', function() { localStorage.setItem(STORAGE_KEY, JSON.stringify({ consent: true, essential: true })); if (banner) banner.classList.remove('show'); }); }
            var declineBtn = document.getElementById('cookie-decline-btn');
            if (declineBtn) { declineBtn.addEventListener('click', function() { localStorage.setItem(STORAGE_KEY, JSON.stringify({ consent: false, essential: true })); if (banner) banner.classList.remove('show'); }); }
        })();
    </script>
</body>
</html>
