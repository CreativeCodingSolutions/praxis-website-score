<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Praxis Website Score — Kostenloser Website-Check für Praxen')</title>
    <meta name="description" content="@yield('meta_description', 'Kostenloser Website-Check für Praxen, Handwerker und Restaurants in Deutschland, Österreich und Schweiz. Analyse von Ladegeschwindigkeit, SEO und Mobile-Darstellung.')">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#4F46E5">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta name="keywords" content="Website check, Praxis website, Website bewertung, SEO check, Website analyse, Arzt website, Handwerker website, DACH">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', 'Praxis Website Score — Kostenloser Website-Check für Praxen')">
    <meta property="og:description" content="@yield('og_description', 'Kostenloser Website-Check für Praxen, Handwerker und Restaurants in DACH. Ergebnis in 30 Sekunden.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:locale" content="de_DE">
    <meta property="og:site_name" content="Praxis Website Score">
    @yield('og_tags')

    <!-- Schema.org Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "CreativeCodingSolutions",
        "url": "https://creativecoding.cloud",
        "logo": "https://creativecoding.cloud/logo.png",
        "sameAs": [],
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "availableLanguage": "German"
        }
    }
    </script>
    @yield('schema')

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
    @stack('scripts')
</body>
</html>
