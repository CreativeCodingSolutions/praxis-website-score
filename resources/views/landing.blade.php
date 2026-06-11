<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ihre Website in 30 Sekunden kostenlos bewertet | Praxis Website Score</title>
    <meta name="description" content="Kostenloser Website-Check für Praxen, Handwerker & Restaurants. Wir analysieren Ladegeschwindigkeit, Google-Sichtbarkeit & Mobile-Darstellung. Ergebnis sofort — ohne Anmeldung.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://praxiswebsitescore.creativecoding.cloud/">
    <meta name="keywords" content="Website check, Praxis website, Website bewertung, SEO check, Website analyse, Arzt website, Handwerker website, Restaurant website, DACH">

    <!-- Open Graph -->
    <meta property="og:title" content="Ihre Website in 30 Sekunden kostenlos bewertet | Praxis Website Score">
    <meta property="og:description" content="Kostenloser Website-Check für Praxen, Handwerker & Restaurants in Deutschland, Österreich und Schweiz. Ergebnis sofort.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://praxiswebsitescore.creativecoding.cloud/">
    <meta property="og:locale" content="de_DE">
    <meta property="og:site_name" content="Praxis Website Score">
    <meta property="og:image" content="https://praxiswebsitescore.creativecoding.cloud/og-image.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Praxis Website Score — Kostenloser Website-Check für Praxen, Handwerker & Restaurants">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ihre Website in 30 Sekunden kostenlos bewertet | Praxis Website Score">
    <meta name="twitter:description" content="Kostenloser Website-Check für Praxen, Handwerker & Restaurants in Deutschland, Österreich und Schweiz. Ergebnis sofort.">

    <!-- Schema.org -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "Praxis Website Score",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "Web",
        "description": "Kostenloser Website-Check für Praxen, Handwerker und lokale Unternehmen in DACH. Analyse von Ladegeschwindigkeit, SEO, Mobile-Darstellung, HTTPS und DSGVO-Konformität.",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "EUR"
        },
        "creator": {
            "@type": "Organization",
            "name": "CreativeCodingSolutions",
            "url": "https://creativecoding.cloud"
        },
        "areaServed": [
            {"@type": "Country", "name": "Deutschland"},
            {"@type": "Country", "name": "Österreich"},
            {"@type": "Country", "name": "Schweiz"}
        ],
    }
    </script>
    <!-- Schema.org FAQ -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Was kostet der Website-Check?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Der Basis-Website-Check ist komplett kostenlos. Sie erhalten sofort einen Score von 0-100 und konkrete Verbesserungshinweise. Für detaillierte PDF-Reports und unbegrenzte Checks gibt es den Pro-Report ab 19€/Monat."
                }
            },
            {
                "@type": "Question",
                "name": "Wie lange dauert die Analyse?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Die Analyse dauert etwa 30 Sekunden. Wir prüfen Ladegeschwindigkeit, Google-Sichtbarkeit, Mobile-Darstellung, HTTPS, Impressum und DSGVO-Konformität."
                }
            },
            {
                "@type": "Question",
                "name": "Ist der Website-Check DSGVO-konform?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ja. Wir verwenden keine Cookies, kein Tracking und speichern keine persönlichen Daten. Die Analyse-Ergebnisse werden nur für Sie angezeigt. Unsere Server stehen in Deutschland."
                }
            },
            {
                "@type": "Question",
                "name": "Für welche Branchen ist der Check geeignet?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Der Check ist für alle lokalen Unternehmen im DACH-Raum optimiert: Arztpraxen, Zahnärzte, Therapeuten, Handwerker, Restaurants, Rechtsanwälte, Wellness-Studios und mehr."
                }
            }
        ]
    }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #cookie-banner { display: none; }
        #cookie-banner.show { display: block; }
    </style>
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- DSGVO Cookie Consent Banner -->
    <div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-gray-900 text-white p-4 z-[100] shadow-lg">
        <div class="max-w-5xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-300">
                Wir verwenden keine Cookies und tracken Sie nicht. Diese Website speichert nur Ihre Analyse-Ergebnisse.
                <a href="/datenschutz" class="underline hover:no-underline text-indigo-400">Datenschutzerklärung</a>
            </p>
            <button onclick="document.getElementById('cookie-banner').classList.remove('show')"
                    class="bg-indigo-600 text-white px-4 py-2 rounded text-sm font-medium hover:bg-indigo-700 transition whitespace-nowrap">
                Verstanden
            </button>
        </div>
    </div>

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
                <a href="#hero-form" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-sm font-medium">Jetzt Website prüfen</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section id="hero-form" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="max-w-2xl">
            <p class="text-sm font-medium text-indigo-600 mb-3">Für Praxen, Handwerker & Restaurants in DACH</p>
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 leading-tight mb-6">
                Ihre Website in 30 Sekunden kostenlos bewertet
            </h1>
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                Ladegeschwindigkeit, Google-Sichtbarkeit, Darstellung auf dem Handy — wir prüfen Ihre Website auf die Dinge, die für lokale Kunden wirklich zählen. Kostenlos, ohne Anmeldung, Ergebnis sofort.
            </p>

            <form action="{{ route('guest.score.analyze') }}" method="POST" class="mb-4">
                @csrf
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="url" name="url" required placeholder="Ihre Website-Adresse (z.B. www.muster-praxis.de)"
                           class="flex-1 px-4 py-3 border border-gray-300 rounded-lg text-base focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-3 rounded-lg text-base font-medium hover:bg-indigo-700 transition">
                        Jetzt Website prüfen
                    </button>
                </div>
            </form>
            <p class="text-sm text-gray-500">✓ Kostenlos &nbsp; ✓ Keine Anmeldung &nbsp; ✓ Ergebnis in 30 Sekunden</p>
        </div>
    </section>

    <!-- Vertrauens-Signal -->
    <section class="border-t border-b border-gray-200 py-8 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-8 text-sm text-gray-500">
                <span class="flex items-center gap-2"><i class="fa-solid fa-shield-halved text-green-500"></i> DSGVO-konform</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-server text-green-500"></i> Serverstandort Deutschland</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-eye-slash text-green-500"></i> Kein Tracking</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Keine Kreditkarte nötig</span>
            </div>
        </div>
    </section>

    <!-- Problem-Abschnitt -->
    <section class="bg-white py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Typische Probleme bei lokalen Websites</h2>
            <p class="text-gray-600 mb-8 max-w-xl">Wir analysieren regelmäßig Websites von Praxen, Handwerkern und Restaurants in Deutschland, Österreich und Schweiz. Das finden wir am häufigsten:</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fa-solid fa-magnifying-glass text-red-500"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Patienten finden Sie nicht bei Google</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Wenn Ihre Praxis nicht auf der ersten Seite bei Google auftaucht, suchen Patienten weiter. Besonders in Großstädten wie München, Wien oder Zürich ist die Konkurrenz groß.</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fa-solid fa-gauge-high text-orange-500"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Die Seite lädt zu langsam</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Jede Sekunde Ladezeit kostet Sie Besucher. Gerade auf dem Handy, wo viele lokale Suchen stattfinden, muss eine Seite in unter 3 Sekunden laden.</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fa-solid fa-mobile-screen text-yellow-600"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Auf dem Handy sieht alles anders aus</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Buttons zu klein, Text nicht lesbare, Bilder abschneidend — viele Praxis-Seiten wurden für den Desktop gemacht und vernachlässigen die mobile Darstellung.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- DACH-Beispiele -->
    <section class="bg-gray-50 border-t border-b border-gray-200 py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">So könnte Ihr Ergebnis aussehen</h2>
            <p class="text-gray-600 mb-8 max-w-xl">Wir zeigen Ihnen konkret, wo Ihre Website steht — ohne Verkaufsdruck.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Beispiel 1: Zahnarztpraxis München -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-tooth text-indigo-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Zahnarztpraxis München</p>
                            <p class="text-xs text-gray-500">Bayern, Deutschland</p>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between"><span class="text-gray-600">Ladegeschwindigkeit</span><span class="text-orange-600 font-medium">4,2s (zu lang)</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Meta-Titel</span><span class="text-red-600 font-medium">Fehlt</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Mobile</span><span class="text-orange-600 font-medium">Teilweise</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">HTTPS</span><span class="text-green-600 font-medium">✓ Aktiv</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Impressum</span><span class="text-green-600 font-medium">✓ Vorhanden</span></div>
                    </div>
                </div>

                <!-- Beispiel 2: Handwerker Wien -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-wrench text-amber-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Handwerksbetrieb Wien</p>
                            <p class="text-xs text-gray-500">Österreich</p>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between"><span class="text-gray-600">Ladegeschwindigkeit</span><span class="text-red-600 font-medium">6,8s (kritisch)</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Meta-Titel</span><span class="text-red-600 font-medium">Fehlt</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Mobile</span><span class="text-red-600 font-medium">Nicht optimiert</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">HTTPS</span><span class="text-green-600 font-medium">✓ Aktiv</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Impressum</span><span class="text-red-600 font-medium">Fehlt</span></div>
                    </div>
                </div>

                <!-- Beispiel 3: Restaurant Zürich -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-utensils text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Restaurant Zürich</p>
                            <p class="text-xs text-gray-500">Schweiz</p>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between"><span class="text-gray-600">Ladegeschwindigkeit</span><span class="text-green-600 font-medium">2,1s (gut)</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Meta-Titel</span><span class="text-green-600 font-medium">✓ OK</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Mobile</span><span class="text-green-600 font-medium">✓ Responsive</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">HTTPS</span><span class="text-green-600 font-medium">✓ Aktiv</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Impressum</span><span class="text-green-600 font-medium">✓ Vorhanden</span></div>
                    </div>
                </div>

                <!-- Beispiel 4: Physiotherapie Salzburg -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-person-walking text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Physiotherapie Salzburg</p>
                            <p class="text-xs text-gray-500">Österreich</p>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between"><span class="text-gray-600">Ladegeschwindigkeit</span><span class="text-orange-600 font-medium">3,5s (verbesserbar)</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Meta-Titel</span><span class="text-orange-600 font-medium">Zu lang</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Mobile</span><span class="text-green-600 font-medium">✓ Responsive</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">HTTPS</span><span class="text-green-600 font-medium">✓ Aktiv</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Datenschutz</span><span class="text-red-600 font-medium">Fehlt</span></div>
                    </div>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-4">* Beispiele zeigen typische Befunde. Ihre Ergebnisse können abweichen.</p>
        </div>
    </section>

    <!-- Wie es funktioniert -->
    <section id="wie-es-funktioniert" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">In 3 Schritten zum Website-Score</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold mb-4">1</div>
                <h3 class="font-semibold text-gray-900 mb-2">Website-Adresse eingeben</h3>
                <p class="text-sm text-gray-600">Kopieren Sie die Adresse Ihrer Praxis-, Handwerker- oder Restaurant-Website in das Feld oben.</p>
            </div>
            <div>
                <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold mb-4">2</div>
                <h3 class="font-semibold text-gray-900 mb-2">Automatische Analyse</h3>
                <p class="text-sm text-gray-600">Wir prüfen Ihre Seite auf Ladegeschwindigkeit, Google-Optimierung, Mobile-Darstellung, HTTPS, Impressum und DSGVO-Konformität.</p>
            </div>
            <div>
                <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold mb-4">3</div>
                <h3 class="font-semibold text-gray-900 mb-2">Ergebnis erhalten</h3>
                <p class="text-sm text-gray-600">Sie bekommen einen einfachen Score von 0–100 und konkrete Hinweise, was Sie verbessern können. Auf Wunsch auch als PDF.</p>
            </div>
        </div>
    </section>

    <!-- Branchen -->
    <section class="bg-gray-50 border-t border-b border-gray-200 py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Für alle lokalen Unternehmen</h2>
            <p class="text-gray-600 mb-8">Unser Website-Check ist für verschiedene Branchen im DACH-Raum optimiert.</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <i class="fa-solid fa-user-doctor text-indigo-500 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-gray-900">Arztpraxen</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <i class="fa-solid fa-tooth text-indigo-500 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-gray-900">Zahnärzte</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <i class="fa-solid fa-hand-holding-medical text-indigo-500 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-gray-900">Therapeuten</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <i class="fa-solid fa-wrench text-indigo-500 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-gray-900">Handwerker</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <i class="fa-solid fa-utensils text-indigo-500 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-gray-900">Restaurants</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <i class="fa-solid fa-scale-balanced text-indigo-500 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-gray-900">Rechtsanwälte</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <i class="fa-solid fa-hammer text-indigo-500 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-gray-900">Handwerk</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <i class="fa-solid fa-spa text-indigo-500 text-2xl mb-2"></i>
                    <p class="text-sm font-medium text-gray-900">Wellness & Beauty</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Preise -->
    <section id="preise" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-3">Preise</h2>
        <p class="text-gray-600 mb-8">Der Basis-Check ist kostenlos. Wenn Sie mehr wollen, gibt es den Pro-Report.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl">
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="font-semibold text-gray-900 mb-1">Kostenlos</h3>
                <p class="text-2xl font-bold text-gray-900 mb-4">€0</p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>✓ Einmaliger Basis-Score</li>
                    <li>✓ Sofortiges Ergebnis</li>
                    <li>✓ Verbesserungshinweise</li>
                </ul>
            </div>
            <div class="border-2 border-indigo-500 rounded-lg p-6 relative">
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full">BELIEBT</span>
                <h3 class="font-semibold text-gray-900 mb-1">Pro-Report</h3>
                <p class="text-2xl font-bold text-gray-900 mb-4">€19<span class="text-sm font-normal text-gray-500">/Monat</span></p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>✓ Unbegrenzte Checks</li>
                    <li>✓ PDF-Report</li>
                    <li>✓ Detaillierte Analysen</li>
                    <li>✓ Vergleich mit Branchen-Konkurrenz</li>
                </ul>
                <a href="{{ route('pricing') }}" class="inline-block mt-4 text-sm text-indigo-600 font-medium hover:underline">Alle Preise anzeigen →</a>
            </div>
        </div>
        <p class="text-sm text-gray-500 mt-4">Alle Preise in Euro, zzgl. MwSt. Jederzeit kündbar.</p>
    </section>

    <!-- CTA -->
    <section class="bg-indigo-600 py-16">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Bereit für Ihren Website-Check?</h2>
            <p class="text-indigo-100 mb-8">Testen Sie jetzt kostenlos, wie Ihre Website abschneidet. Keine Anmeldung nötig.</p>
            <a href="#hero-form" class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-medium hover:bg-indigo-50 transition">
                Jetzt Website prüfen
            </a>
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

    <script>
        // Show cookie banner after 1s
        setTimeout(function() {
            document.getElementById('cookie-banner').classList.add('show');
        }, 1000);
    </script>
</body>
</html>
