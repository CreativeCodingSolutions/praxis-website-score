<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website-Score Ergebnis — Praxis Website Score</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- Nav -->
    <nav class="border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-14 items-center">
            <a href="/" class="flex items-center gap-2">
                <span class="text-lg font-semibold text-gray-900">Praxis Website Score</span>
            </a>
            <div class="flex items-center gap-6 text-sm">
                <a href="/#preise" class="text-gray-600 hover:text-gray-900">Preise</a>
                <a href="/login" class="text-gray-600 hover:text-gray-900">Login</a>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Success Banner -->
        <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg p-4 mb-8 text-sm text-center">
            Lead erfolgreich gespeichert! Ihr Website-Score wurde erstellt.
        </div>

        <!-- Score Header -->
        <div class="text-center mb-10">
            <p class="text-sm text-gray-500 mb-2">Website-Score für</p>
            <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ $website_url }}</h1>

            <!-- Score Circle -->
            <div class="inline-flex items-center justify-center w-32 h-32 rounded-full border-8 mb-4
                @if($score >= 80) border-green-500 text-green-600
                @elseif($score >= 50) border-yellow-500 text-yellow-600
                @else border-red-500 text-red-600 @endif">
                <span class="text-4xl font-bold">{{ $score }}</span>
            </div>
            <p class="text-gray-600">
                @if($score >= 80) Gute Website! Einige Optimierungen möglich.
                @elseif($score >= 50) Verbesserungspotenzial vorhanden.
                @else Deutlicher Handlungsbedarf. @endif
            </p>
        </div>

        <!-- Score Breakdown -->
        <div class="space-y-4 mb-10">
            <h2 class="text-lg font-semibold text-gray-900">Kategorie-Ergebnisse</h2>
            @foreach($categories as $key => $cat)
                @php
                    $labels = [
                        'performance' => 'Ladegeschwindigkeit',
                        'seo' => 'Google-Sichtbarkeit',
                        'mobile' => 'Mobile-Darstellung',
                        'content' => 'Inhalt & Struktur',
                        'security' => 'Sicherheit',
                        'design' => 'Gestaltung',
                    ];
                @endphp
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-900">{{ $labels[$key] ?? $key }}</span>
                        <div class="flex items-center gap-2">
                            <div class="w-32 bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full
                                    @if($cat['score'] >= 80) bg-green-500
                                    @elseif($cat['score'] >= 50) bg-yellow-500
                                    @else bg-red-500 @endif"
                                    style="width: {{ $cat['score'] }}%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-600 w-8 text-right">{{ $cat['score'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Lead Info -->
        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6 mb-8">
            <h3 class="font-semibold text-gray-900 mb-2">Ihr Lead wurde gespeichert</h3>
            <p class="text-sm text-gray-600 mb-3">
                Quelle: <span class="font-mono bg-indigo-100 px-2 py-0.5 rounded text-indigo-700">pws_landing</span>
            </p>
            <p class="text-sm text-gray-600">
                Wir haben Ihre Anfrage erhalten. Der detaillierte Report wird Ihnen in Kürze per Email zugestellt.
            </p>
        </div>

        <!-- Upsell -->
        <div class="border border-gray-300 rounded-lg p-6 text-center">
            <h3 class="font-semibold text-gray-900 mb-2">Professionelle Website-Beratung</h3>
            <p class="text-sm text-gray-600 mb-4">Möchten Sie, dass wir Ihre Website optimieren? Unser Pro-Team hilft Ihnen weiter.</p>
            <a href="{{ route('pricing') }}" class="inline-block bg-indigo-600 text-white px-6 py-2.5 rounded text-sm font-medium hover:bg-indigo-700 transition">
                Pro-Report ansehen — €19/Monat
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-gray-200 py-8 mt-12">
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
