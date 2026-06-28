<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSGVO- & Sicherheits-Checkliste für Praxis-Websites | Praxis Website Score</title>
    <meta name="description" content="Kostenlose 15-Punkte-Checkliste für DSGVO, Sicherheit und technische Optimierung Ihrer Praxis-Website.">
    <meta name="robots" content="noindex, follow">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white border-b border-gray-200 py-3">
        <div class="max-w-4xl mx-auto px-4 flex justify-between items-center">
            <span class="text-lg font-semibold text-gray-900">Praxis Website Score</span>
            <a href="/" class="text-sm text-indigo-600 hover:underline">Zurück zur Startseite</a>
        </div>
    </nav>

    <section class="max-w-3xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">15-Punkte DSGVO- & Sicherheits-Checkliste</h1>
        <p class="text-lg text-gray-600 mb-8">Alles, was Ihre Praxis-Website innerhalb einer Woche umsetzen kann. Kostenlos als PDF.</p>

        <!-- Preview -->
        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-8">
            <h2 class="font-semibold text-gray-900 mb-4">Inhalte der Checkliste</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-700">
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> SSL-Zertifikat prüfen und aktivieren</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Impressum auf Pflichtangaben prüfen</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Datenschutz erstellen und verlinken</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</spanent-DSGVO-konform</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Kontaktformular verschlüsseln</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> WordPress/Plugins aktuell halten</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Automatische Backups einrichten</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Analytics DSGVO-konform installieren</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Server-Standort DACH prüfen</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Passwörter und Adminzugriff sichern</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Bilder komprimieren und Lazy-Load</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Mobile-Darstellung testen</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Ladegeschwindigkeit messen</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Google Business verifizieren</div>
                <div class="flex items-start gap-2"><span class="text-green-600 mt-0.5">✓</span> Cookie-Banner ohne Tracking</div>
            </div>
        </div>

        <!-- Email Capture Form -->
        <form action="/security-checklist/download" method="POST" class="bg-white border-2 border-indigo-200 rounded-xl p-6 shadow-sm">
            @csrf
            <h2 class="text-xl font-semibold text-gray-900 mb-2">Jetzt kostenlos PDF erhalten</h2>
            <p class="text-sm text-gray-600 mb-6">E-Mail angeben und sofort PDF-Download erhalten. DSGVO-konform, keine weitere Werbung.</p>

            <div class="flex flex-col gap-4">
                <div>
                    <label for="lm-email" class="block text-sm font-medium text-gray-700 mb-1">E-Mail-Adresse</label>
                    <input type="email" id="lm-email" name="email" required placeholder="ihre@email.de" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="lm-name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-gray-400">(optional)</span></label>
                    <input type="text" id="lm-name" name="name" placeholder="Dr. Müller" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                </div>
                <div class="flex items-start gap-2">
                    <input type="checkbox" id="consent" name="consent" required class="mt-1">
                    <label for="consent" class="text-xs text-gray-600">Ich bin damit einverstanden, dass meine E-Mail-Adresse für den Versand der Checkliste und gelegentlicher Informationen genutzt werden kann. Meine Einwilligung kann ich jederzeit widerrufen. (<a href="/datenschutz" class="underline" target="_blank">Datenschutz</a>)</label>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition text-base">
                    Checkliste PDF herunterladen
                </button>
                <p class="text-xs text-gray-500 text-center">✓ Keine Kreditkarte &nbsp; ✓ Kostenlos &nbsp; ✓ DSGVO-konform</p>
            </div>
        </form>
    </section>

    <footer class="border-t border-gray-200 bg-white py-6 mt-12">
        <div class="max-w-4xl mx-auto px-4 text-center text-sm text-gray-500">
            <a href="/datenschutz" class="underline">Datenschutz</a> &nbsp; | &nbsp; <a href="/impressum" class="underline">Impressum</a> &nbsp; | &nbsp; <a href="/agb" class="underline">AGB</a>
        </div>
    </footer>
</body>
</html>
