<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Praxis Website Score — Kostenloser Website-Check für Praxen')</title>
    <meta name="description" content="@yield('meta_description', 'Kostenloser Website-Check für Praxen, Handwerker und Restaurants in Deutschland, Österreich und Schweiz. Analyse von Ladegeschwindigkeit, SEO und Mobile-Darstellung.')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <meta name="theme-color" content="#4F46E5">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta name="keywords" content="@yield('meta_keywords', 'Website check, Praxis website, Website bewertung, SEO check, Website analyse, Arzt website, Handwerker website, DACH')">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', 'Praxis Website Score — Kostenloser Website-Check für Praxen')">
    <meta property="og:description" content="@yield('og_description', 'Kostenloser Website-Check für Praxen, Handwerker und Restaurants in DACH. Ergebnis in 30 Sekunden.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:locale" content="de_DE">
    <meta property="og:site_name" content="Praxis Website Score">
    <meta property="og:image" content="https://praxiswebsitescore.creativecoding.cloud/og-image.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Praxis Website Score — Kostenloser Website-Check für Praxen in DACH">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ url('/og-image.png') }}">
    @yield('og_tags')

    <!-- Schema.org Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "CreativeCodingSolutions",
        "url": "https://creativecoding.cloud",
        "logo": "https://creativecoding.cloud/logo.png",
        "sameAs": [
            "https://github.com/creativecoding"
        ],
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "availableLanguage": ["German", "English"]
        }
    }
    </script>
    @yield('schema')
    @yield('breadcrumbs')

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('head')
</head>
<body class="bg-gray-50 min-h-screen">
    @auth
    <nav class="bg-white border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <i class="fa-solid fa-gauge-high text-indigo-600 text-xl"></i>
                <span class="font-bold text-lg">Website Score</span>
            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-indigo-600">Dashboard</a>
                <a href="{{ route('dashboard.leads') }}" class="text-sm text-gray-600 hover:text-indigo-600">Leads</a>
                <a href="{{ route('pricing') }}" class="text-sm text-gray-600 hover:text-indigo-600">Preise</a>
                @if(\App\Modules\Reporting\Module::isEnabled())
                <a href="{{ route('reporting.index') }}" class="text-sm text-gray-600 hover:text-indigo-600">Reporting</a>
                @endif
                <span class="text-sm text-gray-400">{{ Auth::user()->name }}</span>
                <form method="POST" action="/logout">@csrf<button class="text-sm text-red-400 hover:text-red-600"><i class="fa-solid fa-right-from-bracket"></i></button></form>
            </div>
        </div>
    </nav>
    @endauth

    <main>
        @if(session('success'))<div class="max-w-7xl mx-auto px-4 mt-4"><div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3">{{ session('success') }}</div></div>@endif
        @if(session('error'))<div class="max-w-7xl mx-auto px-4 mt-4"><div class="bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3">{{ session('error') }}</div></div>@endif
        @yield('content')
    </main>

    <!-- Cookie Consent Banner -->
    <div id="cookie-consent" class="fixed bottom-0 left-0 right-0 z-[100] hidden">
        <div class="max-w-5xl mx-auto px-4 pb-4">
            <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="flex-1">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        <strong class="text-gray-900">Cookies & Datenschutz</strong><br>
                        Wir verwenden nur technisch notwendige Cookies für den Betrieb der Website. Kein Tracking, keine Werbung.
                        Details finden Sie in unserer <a href="{{ route('legal.datenschutz') }}" class="text-indigo-600 underline hover:text-indigo-800">Datenschutzerklärung</a>.
                    </p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <button id="cookie-accept" class="bg-indigo-600 text-white text-sm font-medium px-5 py-2 rounded hover:bg-indigo-700 transition">
                        Akzeptieren
                    </button>
                    <button id="cookie-decline" class="bg-gray-100 text-gray-700 text-sm font-medium px-5 py-2 rounded hover:bg-gray-200 transition">
                        Nur notwendige
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function() {
        var STORAGE_KEY = 'praxis_cookie_consent';
        var banner = document.getElementById('cookie-consent');
        var existing = localStorage.getItem(STORAGE_KEY);
        if (!existing && banner) {
            banner.classList.remove('hidden');
        }
        document.getElementById('cookie-accept').addEventListener('click', function() {
            localStorage.setItem(STORAGE_KEY, JSON.stringify({ consent: true, essential: true, timestamp: new Date().toISOString() }));
            banner.classList.add('hidden');
        });
        document.getElementById('cookie-decline').addEventListener('click', function() {
            localStorage.setItem(STORAGE_KEY, JSON.stringify({ consent: false, essential: true, timestamp: new Date().toISOString() }));
            banner.classList.add('hidden');
        });
    })();
    </script>

    @stack('scripts')
</body>
</html>
