<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website-Score für {{ $data['domain'] }} — Praxis Website Score</title>
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
                <a href="/register" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800 text-sm">Kostenlos prüfen</a>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Score Header -->
        <div class="text-center mb-10">
            <p class="text-sm text-gray-500 mb-2">Website-Score für</p>
            <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ $data['domain'] }}</h1>

            <!-- Score Circle -->
            <div class="inline-flex items-center justify-center w-32 h-32 rounded-full border-8 mb-4
                @if($data['overall_score'] >= 80) border-green-500 text-green-600
                @elseif($data['overall_score'] >= 50) border-yellow-500 text-yellow-600
                @else border-red-500 text-red-600 @endif">
                <span class="text-4xl font-bold">{{ $data['overall_score'] }}</span>
            </div>
            <p class="text-gray-600">
                @if($data['overall_score'] >= 80) Gute Website! Einige Optimierungen möglich.
                @elseif($data['overall_score'] >= 50) Verbesserungspotenzial vorhanden.
                @else Deutlicher Handlungsbedarf. @endif
            </p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg p-4 mb-8 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(!$unlocked)
            <!-- Teaser: Show only top-level scores, gate the details -->
            <div class="space-y-4 mb-10">
                @foreach($data['categories'] as $key => $cat)
                    @php
                        $labels = [
                            'performance' => 'Ladegeschwindigkeit',
                            'seo' => 'Google-Sichtbarkeit',
                            'mobile' => 'Mobile-Darstellung',
                            'content' => 'Inhalt & Struktur',
                            'security' => 'Sicherheit',
                            'design' => 'Design & UX',
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

            <!-- Email Gate -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 text-center">
                <h2 class="text-xl font-bold text-gray-900 mb-2">Detaillierten Report freischalten</h2>
                <p class="text-gray-600 mb-6 text-sm max-w-md mx-auto">
                    Erhalten Sie den vollen Report mit allen Verbesserungshinweisen per Email. Kostenlos, keine Verpflichtung.
                </p>

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-3 mb-4 text-sm text-left">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('guest.score.capture', $uuid) }}" method="POST" class="max-w-sm mx-auto">
                    @csrf
                    <div class="space-y-3 text-left">
                        <div>
                            <input type="text" name="name" placeholder="Ihr Name (optional)"
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-500">
                        </div>
                        <div>
                            <input type="email" name="email" required placeholder="Ihre Email-Adresse"
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-500">
                        </div>
                        <div class="flex items-start gap-2">
                            <input type="checkbox" name="consent" value="1" required id="consent"
                                   class="mt-1" {{ old('consent') ? 'checked' : '' }}>
                            <label for="consent" class="text-xs text-gray-500 leading-tight">
                                Ich bin damit einverstanden, dass meine Daten zur Kontaktaufnahme gespeichert werden.
                                <a href="/datenschutz" class="underline hover:no-underline" target="_blank">Datenschutzerklärung</a>
                            </label>
                        </div>
                        <button type="submit"
                                class="w-full bg-gray-900 text-white px-6 py-2.5 rounded text-sm font-medium hover:bg-gray-800 transition">
                            Report freischalten
                        </button>
                    </div>
                </form>
            </div>

        @else
            <!-- UNLOCKED: Full detailed report -->
            <div class="space-y-6 mb-10">
                @foreach($data['categories'] as $key => $cat)
                    @php
                        $labels = [
                            'performance' => 'Ladegeschwindigkeit',
                            'seo' => 'Google-Sichtbarkeit',
                            'mobile' => 'Mobile-Darstellung',
                            'content' => 'Inhalt & Struktur',
                            'security' => 'Sicherheit',
                            'design' => 'Design & UX',
                        ];
                    @endphp
                    <div class="border border-gray-200 rounded-lg p-5">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-semibold text-gray-900">{{ $labels[$key] ?? $key }}</h3>
                            <span class="text-sm font-bold
                                @if($cat['score'] >= 80) text-green-600
                                @elseif($cat['score'] >= 50) text-yellow-600
                                @else text-red-600 @endif">{{ $cat['score'] }}/100</span>
                        </div>
                        <div class="space-y-1.5">
                            @foreach($cat['checks'] ?? [] as $check)
                                <div class="flex items-start gap-2 text-sm">
                                    <span class="mt-0.5
                                        @if($check[0] === '✓') text-green-600
                                        @elseif($check[0] === '~') text-yellow-600
                                        @else text-red-600 @endif">{{ $check[0] }}</span>
                                    <span class="text-gray-600">{{ $check[1] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Recommendations -->
            @if(!empty($data['recommendations']))
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                    <h3 class="font-semibold text-gray-900 mb-3">Top-Empfehlungen</h3>
                    <ul class="space-y-2">
                        @foreach($data['recommendations'] as $rec)
                            <li class="flex items-start gap-2 text-sm text-gray-700">
                                <span class="text-blue-500 mt-0.5">→</span>
                                <span>{{ $rec }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Upsell -->
            <div class="border border-gray-300 rounded-lg p-6 text-center">
                <h3 class="font-semibold text-gray-900 mb-2">Professionelle Website-Beratung</h3>
                <p class="text-sm text-gray-600 mb-4">Möchten Sie, dass wir Ihre Website optimieren? Unser Pro-Team hilft Ihnen weiter.</p>
                <a href="{{ route('pricing') }}" class="inline-block bg-gray-900 text-white px-6 py-2.5 rounded text-sm font-medium hover:bg-gray-800 transition">
                    Pro-Report ansehen — €19/Monat
                </a>
            </div>
        @endif
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
