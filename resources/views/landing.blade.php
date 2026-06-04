<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praxis Website Score — Kostenlosen Website-Check starten</title>
    <meta name="description" content="Wir analysieren Ihre Praxis-Website: Ladegeschwindigkeit, Google-Sichtbarkeit, Darstellung auf dem Handy. Kostenlos, ohne Anmeldung, Ergebnis sofort.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://praxiswebsitescore.creativecoding.cloud/">
    <meta property="og:title" content="Praxis Website Score — Kostenlosen Website-Check starten">
    <meta property="og:description" content="Wir analysieren Ihre Praxis-Website auf die Dinge, die wirklich zählen.">
    <meta property="og:type" content="website">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- Nav -->
    <nav class="border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-14 items-center">
            <div class="flex items-center gap-2">
                <span class="text-lg font-semibold text-gray-900">Praxis Website Score</span>
            </div>
            <div class="flex items-center gap-6 text-sm">
                <a href="#wie-es-funktioniert" class="text-gray-600 hover:text-gray-900">So funktioniert es</a>
                <a href="#beispiele" class="text-gray-600 hover:text-gray-900">Beispiele</a>
                <a href="{{ route('pricing') }}" class="text-gray-600 hover:text-gray-900">Preise</a>
                <a href="/login" class="text-gray-600 hover:text-gray-900">Login</a>
                <a href="/register" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800 text-sm">Kostenlos prüfen</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="max-w-2xl">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 leading-tight mb-6">
                Ihre Praxis verdient eine Website, die Patienten findet.
            </h1>
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                Wir analysieren Ihre Website auf die Dinge, die wirklich zählen: Ladegeschwindigkeit, Google-Sichtbarkeit, Darstellung auf dem Handy. Das Ergebnis bekommen Sie sofort — keine Anmeldung nötig.
            </p>

            <form action="{{ route('dashboard.check') }}" method="POST" class="mb-4">
                @csrf
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="url" name="url" required placeholder="Ihre Website-Adresse (z.B. www.muster-praxis.de)"
                           class="flex-1 px-4 py-3 border border-gray-300 rounded text-base focus:outline-none focus:border-gray-500">
                    <button type="submit"
                            class="bg-gray-900 text-white px-6 py-3 rounded text-base font-medium hover:bg-gray-800 transition">
                        Website prüfen
                    </button>
                </div>
            </form>
            <p class="text-sm text-gray-500">Kostenlos. Ohne Anmeldung. Ergebnis innerhalb von 2 Minuten.</p>
        </div>
    </section>

    <!-- Problem-Abschnitt -->
    <section class="bg-gray-50 border-t border-b border-gray-200 py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Warum das wichtig ist</h2>
            <p class="text-gray-600 mb-8 max-w-xl">Ihre Website ist oft der erste Eindruck, den Patienten von Ihrer Praxis bekommen. Hier passiert häufig zu viel:</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Patienten finden Sie nicht bei Google</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Wenn Ihre Praxis nicht auf der ersten Seite bei Google auftaucht, suchen Patienten weiter. Die Konkurrenz klickt manchmal nur einen Tab weiter.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Die Seite lädt zu langsam</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Jede Sekunde Ladezeit kostet Sie Besucher. Gerade auf dem Handy, wo die meisten Patienten suchen, darf eine Seite nicht länger als 3 Sekunden brauchen.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Auf dem Handy sieht alles anders aus</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Über 60% aller Gesundheitssuchen werden auf dem Smartphone gemacht. Wenn Ihre Seite dort nicht sauber dargestellt wird, fangen Patienten an zu zweifeln.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Wie es funktioniert — einfach gehalten -->
    <section id="wie-es-funktioniert" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">So geht's</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <p class="text-sm text-gray-500 mb-1">1.</p>
                <h3 class="font-semibold text-gray-900 mb-2">Adresse eingeben</h3>
                <p class="text-sm text-gray-600">Kopieren Sie die Adresse Ihrer Website in das Feld oben.</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">2.</p>
                <h3 class="font-semibold text-gray-900 mb-2">Analyse starten</h3>
                <p class="text-sm text-gray-600">Wir prüfen Ihre Seite auf Ladegeschwindigkeit, Google-Optimierung, Mobile-Darstellung und die Basics wie HTTPS und Impressum.</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">3.</p>
                <h3 class="font-semibold text-gray-900 mb-2">Ergebnis lesen</h3>
                <p class="text-sm text-gray-600">Sie bekommen einen einfachen Score und konkrete Hinweise, was man verbessern kann. Auf Wunsch auch als PDF.</p>
            </div>
        </div>
    </section>

    <!-- Beispiel-Ergebnisse (statt Fake-Testimonials) -->
    <section id="beispiele" class="bg-gray-50 border-t border-b border-gray-200 py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">So könnte Ihr Ergebnis aussehen</h2>
            <p class="text-gray-600 mb-8 max-w-xl">Wir zeigen Ihnen konkret, wo Ihre Website steht — ohne Verkaufsdruck.</p>

            <div class="bg-white border border-gray-200 rounded-lg p-6 font-mono text-sm max-w-lg">
                <p class="text-gray-400 mb-2"># Beispiel-Analyse für eine Praxis-Website</p>
                <p class="mb-4">Ladegeschwindigkeit: <span class="text-orange-600">4,2 Sekunden</span> (sollte unter 3s sein)</p>
                <p class="mb-4">Meta-Titel: <span class="text-red-600">Fehlt</span> (Google kann Ihre Seite nicht richtig indexieren)</p>
                <p class="mb-4">Mobile-Darstellung: <span class="text-orange-600">Teilweise</span> (Buttons zu klein auf dem Handy)</p>
                <p class="mb-4">HTTPS: <span class="text-green-600">Aktiv</span></p>
                <p class="mb-4">Impressum: <span class="text-green-600">Vorhanden</span></p>
                <p class="mb-2">Datenschutz: <span class="text-red-600">Fehlt</span></p>
                <p class="mt-4 text-gray-500 text-xs">— Das sind typische Funde bei Praxis-Websites.</p>
            </div>
        </div>
    </section>

    <!-- Preise — kurz und ehrlich -->
    <section id="preise" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-3">Preise</h2>
        <p class="text-gray-600 mb-8">Der Basis-Check ist kostenlos. Wenn Sie mehr wollen, gibt es den Pro-Report.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl">
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="font-semibold text-gray-900 mb-1">Kostenlos</h3>
                <p class="text-2xl font-bold text-gray-900 mb-4">€0</p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>Einmaliger Basis-Score</li>
                    <li>Sofortiges Ergebnis</li>
                    <li>Verbesserungshinweise</li>
                </ul>
            </div>
            <div class="border border-gray-300 rounded-lg p-6">
                <h3 class="font-semibold text-gray-900 mb-1">Pro-Report</h3>
                <p class="text-2xl font-bold text-gray-900 mb-4">€19<span class="text-sm font-normal text-gray-500">/Monat</span></p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>Unbegrenzte Checks</li>
                    <li>PDF-Report</li>
                    <li>Detaillierte Analysen</li>
                    <li>Vergleich mit Branchen-Konkurrenz</li>
                </ul>
                <a href="{{ route('pricing') }}" class="inline-block mt-4 text-sm text-gray-900 underline hover:no-underline">Alle Preise anzeigen →</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-200 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <p class="text-sm text-gray-500">© {{ date('Y') }} Praxis Website Score. Ein Projekt von CreativeCodingSolutions.</p>
                <div class="flex gap-6 text-sm text-gray-500">
                    <a href="/datenschutz" class="hover:text-gray-900">Datenschutz</a>
                    <a href="/impressum" class="hover:text-gray-900">Impressum</a>
                    <a href="/agb" class="hover:text-gray-900">AGB</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
