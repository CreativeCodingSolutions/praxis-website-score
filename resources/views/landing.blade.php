<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praxis Website Score — Deine Website in 60 Sekunden bewertet | Kostenlos analysieren</title>
    <meta name="description" content="Erhalte einen detaillierten Website-Score für Performance, SEO, Mobile, Content, Sicherheit und Design. Kostenlos, keine Kreditkarte nötig.">
    <meta name="keywords" content="Website Analyse, Website Score, SEO Check, Performance Test, Praxis Website, Therapeut Website">
    <link rel="canonical" href="https://praxiswebsitescore.creativecoding.cloud/">
    <meta property="og:title" content="Praxis Website Score — Deine Website in 60 Sekunden bewertet">
    <meta property="og:description" content="Kostenlose Website-Analyse für Therapeuten, Ärzte & Dienstleister. PDF-Report in 60 Sekunden.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://praxiswebsitescore.creativecoding.cloud/">
    <meta name="twitter:card" content="summary_large_image">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "Praxis Website Score",
        "description": "Automatisierte Website-Analyse mit PDF-Reports für Therapeuten und Praxen",
        "url": "https://praxiswebsitescore.creativecoding.cloud",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "Web",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "EUR"
        }
    }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .gradient-text { background: linear-gradient(135deg, #4F46E5, #7C3AEB); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .pulse-btn { animation: pulse 2s infinite; }
        @keyframes pulse { 0%, 100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); } 50% { box-shadow: 0 0 0 12px rgba(79, 70, 229, 0); } }
        .fade-in { animation: fadeIn 0.6s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-white">
    <!-- Nav -->
    <nav class="border-b sticky top-0 bg-white/95 backdrop-blur-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <div class="flex items-center gap-2"><i class="fa-solid fa-gauge-high text-indigo-600 text-xl"></i><span class="font-bold text-lg">Website Score</span></div>
            <div class="hidden md:flex items-center gap-6">
                <a href="#how-it-works" class="text-sm text-gray-600 hover:text-indigo-600">So funktioniert's</a>
                <a href="#features" class="text-sm text-gray-600 hover:text-indigo-600">Features</a>
                <a href="#testimonials" class="text-sm text-gray-600 hover:text-indigo-600">Erfahrungen</a>
                <a href="{{ route('pricing') }}" class="text-sm text-gray-600 hover:text-indigo-600">Preise</a>
            </div>
            <div class="flex items-center gap-4">
                <a href="/login" class="text-sm text-gray-600 hover:text-indigo-600">Login</a>
                <a href="/register" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 pulse-btn">Kostenlos starten</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="inline-block px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium mb-6 fade-in">✨ Sofort-Analyse · Keine Anmeldung nötig</div>
        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight fade-in">Deine Website.<br><span class="gradient-text">In 60 Sekunden bewertet.</span></h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-10 fade-in">Erhalte einen detaillierten Score für Performance, SEO, Mobile, Content, Sicherheit und Design — speziell für Therapeuten, Ärzte & Dienstleister.</p>

        <form action="{{ route('dashboard.check') }}" method="POST" class="max-w-2xl mx-auto fade-in">
            @csrf
            <div class="flex flex-col sm:flex-row gap-3 p-2 bg-white rounded-2xl shadow-xl border">
                <input type="url" name="url" required placeholder="https://www.deine-praxis.de" class="flex-1 px-5 py-3 text-lg outline-none rounded-xl">
                <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold text-lg hover:bg-indigo-700 transition">
                    <i class="fa-solid fa-bolt mr-2"></i>Jetzt analysieren
                </button>
            </div>
        </form>
        <p class="text-sm text-gray-400 mt-4">Kostenlos · Keine Kreditkarte · PDF-Report verfügbar</p>

        <!-- Trust Badges -->
        <div class="flex flex-wrap justify-center gap-6 mt-10 text-sm text-gray-400">
            <span><i class="fa-solid fa-shield-halved text-green-500 mr-1"></i>DSGVO-konform</span>
            <span><i class="fa-solid fa-bolt text-yellow-500 mr-1"></i>60 Sekunden</span>
            <span><i class="fa-solid fa-file-pdf text-red-500 mr-1"></i>PDF-Report</span>
            <span><i class="fa-solid fa-users text-indigo-500 mr-1"></i>500+ Analysen</span>
        </div>
    </section>

    <!-- Pain Points -->
    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-4">Kennst du das?</h2>
            <p class="text-gray-500 text-center mb-12 max-w-xl mx-auto">Therapeuten und Ärzte investieren Tausende in ihre Praxis — aber die Website wird vernachlässigt.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition">
                    <div class="text-3xl mb-3">😰</div>
                    <h3 class="font-semibold mb-2">"Meine Website sieht alt aus"</h3>
                    <p class="text-sm text-gray-500">Patienten urteilen in Sekunden. Ein veraltetes Design kostet dir neue Klienten.</p>
                </div>
                <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition">
                    <div class="text-3xl mb-3">🔍</div>
                    <h3 class="font-semibold mb-2">"Ich finde mich nicht auf Google"</h3>
                    <p class="text-sm text-gray-500">Ohne SEO-Strategie bleibst du unsichtbar — auch wenn du der beste Therapeut bist.</p>
                </div>
                <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition">
                    <div class="text-3xl mb-3">📱</div>
                    <h3 class="font-semibold mb-2">"Auf Handy sieht alles komisch aus"</h3>
                    <p class="text-sm text-gray-500">70% der Suchen sind mobil. Wenn deine Seite nicht responsive ist, verlierst du Patienten.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-4">6 Kategorien. 50+ Kriterien. 1 Score.</h2>
        <p class="text-gray-500 text-center mb-12 max-w-xl mx-auto">Unsere Analyse prüft alle relevanten Aspekte deiner Website.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="flex gap-4 p-5 rounded-xl border hover:shadow-md transition">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center shrink-0"><i class="fa-solid fa-gauge-high text-blue-600 text-xl"></i></div>
                <div><h3 class="font-semibold mb-1">Performance</h3><p class="text-sm text-gray-500">Ladezeit, Core Web Vitals, Server-Response, Caching</p></div>
            </div>
            <div class="flex gap-4 p-5 rounded-xl border hover:shadow-md transition">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center shrink-0"><i class="fa-solid fa-magnifying-glass text-green-600 text-xl"></i></div>
                <div><h3 class="font-semibold mb-1">SEO</h3><p class="text-sm text-gray-500">Meta-Tags, Open Graph, Strukturierte Daten, Sitemap</p></div>
            </div>
            <div class="flex gap-4 p-5 rounded-xl border hover:shadow-md transition">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center shrink-0"><i class="fa-solid fa-mobile-screen text-purple-600 text-xl"></i></div>
                <div><h3 class="font-semibold mb-1">Mobile</h3><p class="text-sm text-gray-500">Responsive Design, Viewport, Touch-Targets, Font-Größen</p></div>
            </div>
            <div class="flex gap-4 p-5 rounded-xl border hover:shadow-md transition">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center shrink-0"><i class="fa-solid fa-shield-halved text-red-600 text-xl"></i></div>
                <div><h3 class="font-semibold mb-1">Sicherheit</h3><p class="text-sm text-gray-500">HTTPS, Security-Headers, Datenschutz, Impressum</p></div>
            </div>
            <div class="flex gap-4 p-5 rounded-xl border hover:shadow-md transition">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center shrink-0"><i class="fa-solid fa-pen-fancy text-yellow-600 text-xl"></i></div>
                <div><h3 class="font-semibold mb-1">Content</h3><p class="text-sm text-gray-500">Überschriften-Struktur, Bilder, Textlänge, CTAs</p></div>
            </div>
            <div class="flex gap-4 p-5 rounded-xl border hover:shadow-md transition">
                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center shrink-0"><i class="fa-solid fa-palette text-indigo-600 text-xl"></i></div>
                <div><h3 class="font-semibold mb-1">Design</h3><p class="text-sm text-gray-500">Kontrast, Whitespace, Konsistenz, Typografie</p></div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section id="how-it-works" class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">In 3 Schritten zum besseren Website-Score</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4"><span class="text-2xl font-bold text-indigo-600">1</span></div>
                    <h3 class="font-semibold mb-2">URL eingeben</h3>
                    <p class="text-sm text-gray-500">Gib die Website-Adresse ein, die du analysieren möchtest.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4"><span class="text-2xl font-bold text-indigo-600">2</span></div>
                    <h3 class="font-semibold mb-2">Automatische Analyse</h3>
                    <p class="text-sm text-gray-500">Unser System prüft 50+ Kriterien in 6 Kategorien.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4"><span class="text-2xl font-bold text-indigo-600">3</span></div>
                    <h3 class="font-semibold mb-2">PDF-Report erhalten</h3>
                    <p class="text-sm text-gray-500">Lade dir den detaillierten Report herunter und zeig ihn deinem Webdesigner.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-4">Was unsere Nutzer sagen</h2>
        <p class="text-gray-500 text-center mb-12 max-w-xl mx-auto">Therapeuten und Ärzte vertrauen auf unseren Website-Score.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl p-6 border shadow-sm">
                <div class="flex items-center gap-1 text-yellow-400 mb-3">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-gray-600 text-sm mb-4">"Endlich weiß ich, was an meiner Website nicht stimmt. Der Report hat mir geholfen, gezielt Verbesserungen vorzunehmen."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center"><i class="fa-solid fa-user text-indigo-600"></i></div>
                    <div><p class="font-semibold text-sm">Dr. Maria Schmidt</p><p class="text-xs text-gray-400">Psychologische Psychotherapeutin</p></div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-6 border shadow-sm">
                <div class="flex items-center gap-1 text-yellow-400 mb-3">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-gray-600 text-sm mb-4">"Ich habe den Report meinem Webdesigner gezeigt. Innerhalb einer Woche war die Website deutlich besser!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center"><i class="fa-solid fa-user text-green-600"></i></div>
                    <div><p class="font-semibold text-sm">Thomas Müller</p><p class="text-xs text-gray-400">Physiotherapeut</p></div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-6 border shadow-sm">
                <div class="flex items-center gap-1 text-yellow-400 mb-3">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <p class="text-gray-600 text-sm mb-4">"Schnell, einfach und aussagekräftig. Mein Score hat sich von 45 auf 82 verbessert — und meine Anfragen sind gestiegen!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center"><i class="fa-solid fa-user text-purple-600"></i></div>
                    <div><p class="font-semibold text-sm">Sabine Weber</p><p class="text-xs text-gray-400">Zahnärztin</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lead Capture CTA -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 py-16">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Kostenlosen Website-Score erhalten</h2>
            <p class="text-indigo-100 mb-8">Gib deine Website-URL ein und erhalte sofort einen detaillierten Analyse-Report.</p>
            <form action="{{ route('dashboard.check') }}" method="POST" class="max-w-xl mx-auto">
                @csrf
                <div class="flex flex-col sm:flex-row gap-3">
                    <input type="url" name="url" required placeholder="https://www.deine-praxis.de" class="flex-1 px-5 py-3 rounded-xl text-lg outline-none">
                    <button type="submit" class="bg-white text-indigo-600 px-8 py-3 rounded-xl font-bold text-lg hover:bg-indigo-50 transition">
                        <i class="fa-solid fa-bolt mr-2"></i>Jetzt analysieren
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-400">© {{ date('Y') }} Praxis Website Score · Erstellt mit ❤️ für Therapeuten & Dienstleister</p>
                <div class="flex gap-4 text-sm text-gray-400">
                    <a href="#" class="hover:text-indigo-600">Datenschutz</a>
                    <a href="#" class="hover:text-indigo-600">Impressum</a>
                    <a href="#" class="hover:text-indigo-600">Kontakt</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
