<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praxis Website Score — Deine Website in 60 Sekunden bewertet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-white">
    <!-- Nav -->
    <nav class="border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <div class="flex items-center gap-2"><i class="fa-solid fa-gauge-high text-indigo-600 text-xl"></i><span class="font-bold text-lg">Website Score</span></div>
            <div class="flex items-center gap-4">
                <a href="{{ route('pricing') }}" class="text-sm text-gray-600 hover:text-indigo-600">Preise</a>
                <a href="/login" class="text-sm text-gray-600 hover:text-indigo-600">Login</a>
                <a href="/register" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Kostenlos starten</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="inline-block px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium mb-6">✨ Sofort-Analyse · Keine Anmeldung nötig</div>
        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">Deine Website.<br><span class="text-indigo-600">In 60 Sekunden bewertet.</span></h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-10">Erhalte einen detaillierten Score für Performance, SEO, Mobile, Content, Sicherheit und Design — speziell für Therapeuten, Ärzte & Dienstleister.</p>

        <form action="{{ route('dashboard.check') }}" method="POST" class="max-w-2xl mx-auto">
            @csrf
            <div class="flex flex-col sm:flex-row gap-3 p-2 bg-white rounded-2xl shadow-xl border">
                <input type="url" name="url" required placeholder="https://www.deine-praxis.de" class="flex-1 px-5 py-3 text-lg outline-none rounded-xl">
                <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold text-lg hover:bg-indigo-700 transition">
                    <i class="fa-solid fa-bolt mr-2"></i>Jetzt analysieren
                </button>
            </div>
        </form>
        <p class="text-sm text-gray-400 mt-4">Kostenlos · Keine Kreditkarte · PDF-Report verfügbar</p>
    </section>

    <!-- Pain Points -->
    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-4">Kennst du das?</h2>
            <p class="text-gray-500 text-center mb-12 max-w-xl mx-auto">Therapeuten und Ärzte investieren Tausende in ihre Praxis — aber die Website wird vernachlässigt.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl p-6 border shadow-sm">
                    <div class="text-3xl mb-3">😰</div>
                    <h3 class="font-semibold mb-2">"Meine Website sieht alt aus"</h3>
                    <p class="text-sm text-gray-500">Patienten urteilen in Sekunden. Ein veraltetes Design kostet dir neue Klienten.</p>
                </div>
                <div class="bg-white rounded-xl p-6 border shadow-sm">
                    <div class="text-3xl mb-3">🔍</div>
                    <h3 class="font-semibold mb-2">"Ich finde mich nicht auf Google"</h3>
                    <p class="text-sm text-gray-500">Ohne SEO-Strategie bleibst du unsichtbar — auch wenn du der beste Therapeut bist.</p>
                </div>
                <div class="bg-white rounded-xl p-6 border shadow-sm">
                    <div class="text-3xl mb-3">📱</div>
                    <h3 class="font-semibold mb-2">"Auf Handy sieht alles komisch aus"</h3>
                    <p class="text-sm text-gray-500">70% der Suchen sind mobil. Wenn deine Seite nicht responsive ist, verlierst du Patienten.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
    </section>

    <!-- CTA -->
    <section class="bg-indigo-600 py-16">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Bereit für einen besseren Website-Score?</h2>
            <p class="text-indigo-100 mb-8">Starte jetzt kostenlos. Keine Kreditkarte nötig.</p>
            <a href="/register" class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-xl font-bold text-lg hover:bg-indigo-50 transition">
                Kostenlos analysieren →
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t py-8 text-center text-sm text-gray-400">
        <p>© {{ date('Y') }} Praxis Website Score · Erstellt mit ❤️ für Therapeuten & Dienstleister</p>
    </footer>
</body>
</html>
