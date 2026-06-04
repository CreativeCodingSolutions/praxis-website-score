@extends('layouts.app')

@section('title', 'Blog | Praxis Website Score — Website-Tipps für Praxen in DACH')
@section('meta_description', 'Blog über Website-Optimierung, SEO, Online-Marketing und Webdesign für Ärzte, Zahnärzte, Therapeuten und Praxen in Deutschland, Österreich und Schweiz.')

@section('og_tags')
<meta property="og:title" content="Blog | Praxis Website Score — Website-Tipps für Praxen in DACH">
<meta property="og:description" content="Tipps für bessere Praxis-Websites, mehr Patienten und stärkere Google-Sichtbarkeit im DACH-Raum.">
<meta property="og:type" content="website">
<meta property="og:locale" content="de_DE">
@endsection

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Blog",
    "name": "Praxis Website Score Blog",
    "description": "Tipps für bessere Praxis-Websites, mehr Patienten und stärkere Google-Sichtbarkeit im DACH-Raum.",
    "publisher": {
        "@type": "Organization",
        "name": "CreativeCodingSolutions"
    },
    "inLanguage": "de-DE"
}
</script>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-2">Blog</h1>
    <p class="text-gray-500 mb-12">Tipps für bessere Praxis-Websites, mehr Patienten und stärkere Google-Sichtbarkeit im DACH-Raum.</p>

    <div class="space-y-8">
        <!-- Post 1 -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">Patientenakquise & Website</p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="{{ route('blog.show', '10-gruende-warum-ihre-praxis-website-patienten-verliert') }}" class="hover:text-indigo-600">10 Gründe warum Ihre Praxis-Website Patienten verliert</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">4. Juni 2026 · Lesezeit: 8 Min.</p>
            <p class="text-gray-600">Viele Praxis-Websites verlieren Patienten ohne es zu merken. Wir zeigen 10 häufige Fehler — und wie Sie sie beheben. Mit DACH-Beispielen und SEO-Tipps.</p>
        </article>

        <!-- Post 2 -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">Webdesign & Best Practices</p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="{{ route('blog.show', 'website-check-professionelle-praxis-seiten') }}" class="hover:text-indigo-600">Website-Check: So sehen professionelle Praxis-Seiten aus</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">4. Juni 2026 · Lesezeit: 7 Min.</p>
            <p class="text-gray-600">Was macht eine professionelle Praxis-Website aus? Wir analysieren die Merkmale erfolgreicher Arzt-, Zahnarzt- und Therapeuten-Websites mit DACH-Beispielen und Checklisten.</p>
        </article>

        <!-- Post 3 -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">SEO & Google-Sichtbarkeit</p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="{{ route('blog.show', 'seo-fuer-aerzte-und-therapeuten') }}" class="hover:text-indigo-600">SEO für Ärzte und Therapeuten — Leitfaden 2026</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">4. Juni 2026 · Lesezeit: 10 Min.</p>
            <p class="text-gray-600">SEO-Leitfaden für Ärzte, Zahnärzte und Therapeuten: So werden Sie auf Google in Deutschland, Österreich und Schweiz gefunden. Lokale SEO, On-Page-Optimierung und Google My Business.</p>
        </article>
    </div>

    <!-- CTA -->
    <div class="mt-12 bg-indigo-50 border border-indigo-200 rounded-lg p-6 text-center">
        <h3 class="text-lg font-semibold text-indigo-900 mb-2">Ihre Praxis-Website testen</h3>
        <p class="text-indigo-800 text-sm mb-4">Kostenloser Website-Check — Ergebnis in 30 Sekunden.</p>
        <a href="/" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">Jetzt Website prüfen →</a>
    </div>
</div>
@endsection
