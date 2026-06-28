@extends('layouts.app')

@section('title', 'SEO für Ärzte und Therapeuten — Leitfaden 2026 | Praxis Website Score Blog')
@section('meta_description', 'Praxis SEO Optimierung: SEO-Leitfaden für Ärzte & Therapeuten 2026. Lokale SEO & Google Business Profile für mehr Patienten — jetzt Score prüfen →')

@section('og_tags')
<meta property="og:title" content="SEO für Ärzte und Therapeuten — Leitfaden 2026">
<meta property="og:description" content="SEO-Leitfaden für Ärzte, Zahnärzte und Therapeuten: So werden Sie auf Google in Deutschland, Österreich und Schweiz gefunden.">
<meta property="og:type" content="article">
<meta property="og:locale" content="de_DE">
@endsection

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": "SEO für Ärzte und Therapeuten — Leitfaden 2026",
    "description": "SEO-Leitfaden für Ärzte, Zahnärzte und Therapeuten: So werden Sie auf Google in Deutschland, Österreich und Schweiz gefunden. Lokale SEO, On-Page-Optimierung und Google My Business.",
    "author": {
        "@type": "Organization",
        "name": "CreativeCodingSolutions"
    },
    "publisher": {
        "@type": "Organization",
        "name": "Praxis Website Score"
    },
    "datePublished": "2026-06-04",
    "inLanguage": "de-DE",
    "keywords": "SEO Ärzte, SEO Therapeuten, lokale SEO, Google My Business, Praxis SEO, Arzt Google Ranking, DACH SEO 2026"
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "Was ist lokale SEO für Praxen?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Lokale SEO optimiert Ihre Praxis-Website und Google Business Profile dafür, bei lokalen Suchanfragen wie 'Zahnarzt in München' oder 'Physio Wien' in den Top-Ergebnissen zu erscheinen. Es umfasst Google Business Profile Optimierung, lokale Keywords, NAP-Konsistenz und Bewertungsmanagement."
            }
        },
        {
            "@type": "Question",
            "name": "Wie lange dauert es, bis SEO-Maßnahmen bei einer Arztpraxis Wirkung zeigen?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Erste Verbesserungen in den lokalen Suchergebnissen sind typischerweise nach 4-8 Wochen sichtbar. Google Business Profile Optimierung zeigt oft schon nach 1-2 Wochen Effekte. Vollständige SEO-Ergebnisse benötigen 3-6 Monate kontinuierlicher Arbeit."
            }
        },
        {
            "@type": "Question",
            "name": "Ist Google Business Profile wichtiger als die Website für Praxen?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Beide sind wichtig, aber Google Business Profile hat für lokale Sichtbarkeit oft mehr unmittelbare Wirkung. 46% aller Google-Suchen haben lokale Absicht. Eine optimierte Praxis-Website konvertiert Besucher besser in Patienten. Die Kombination aus beidem ist ideal."
            }
        },
        {
            "@type": "Question",
            "name": "Welche Keywords sollte eine Arztpraxis optimieren?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Fokussieren Sie sich auf lokale Long-Tail-Keywords wie '[Fachrichtung] in [Stadt]', '[Behandlung] [Stadt]' und '[Branche] near me'. Vermeiden Sie generische Keywords wie 'Arzt' — die Konkurrenz ist zu hoch. Arbeiten Sie stattdessen spezifische Leistungs- und Standort-Keywords ein."
            }
        }
    ]
}
</script>
@endsection

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-8">
        <a href="/" class="hover:text-indigo-600">Startseite</a>
        <span class="mx-2">/</span>
        <a href="{{ route('blog.index') }}" class="hover:text-indigo-600">Blog</a>
        <span class="mx-2">/</span>
        <span class="text-gray-700">SEO für Ärzte und Therapeuten — Leitfaden 2026</span>
    </nav>

    <article>
        <header class="mb-10">
            <p class="text-sm text-indigo-600 font-medium mb-2">SEO & Google-Sichtbarkeit</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">SEO für Ärzte und Therapeuten — Leitfaden 2026</h1>
            <p class="text-gray-500 text-sm">Veröffentlicht am 4. Juni 2026 · Lesezeit: 10 Minuten</p>
        </header>

        <div class="prose prose-lg max-w-none text-gray-700">
            <p class="lead text-xl text-gray-600 mb-8">
                "Dr. Müller Zahnarzt München" — wenn Ihre Praxis nicht in den ersten 3 Ergebnissen auftaucht, verlieren Sie Patienten an die Konkurrenz. SEO für Ärzte und Therapeuten ist kein Zufall, sondern eine Methode. Dieser Leitfaden zeigt Ihnen, wie Sie in Deutschland, Österreich und der Schweiz auf Google gefunden werden.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-4">Was ist lokale SEO und warum ist sie für Praxen so wichtig?</h2>
            <p>Lokale SEO (Suchmaschinenoptimierung) bedeutet: Ihre Praxis wird bei ortsbezogenen Suchanfragen gefunden. Beispiele:</p>
            <ul class="list-disc list-inside space-y-1 mt-2">
                <li>"Zahnarzt in München"</li>
                <li>"Physiotherapeut Nähe Wien"</li>
                <li>"Hausarzt Zürich"</li>
                <li>"Dermatologe Berlin"</li>
            </ul>
            <p class="mt-4">Google zeigt bei diesen Suchanfragen lokale Ergebnisse — die berühmte "Local Pack" mit Karte und drei Einträgen. Wer dort auftaucht, bekommt die meisten Klicks und Anrufe.</p>

            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-4">Schritt 1: Google My Business (Google Business Profile)</h2>
            <p>Das Fundament der lokalen SEO. Ihr Google Business Profile ist Ihre Visitenkarte bei Google — und es ist kostenlos.</p>

            <h3 class="text-xl font-semibold text-gray-900 mt-8 mb-3">Was Sie einrichten sollten:</h3>
            <ul class="list-disc list-inside space-y-2">
                <li><strong>Vollständige Praxisadresse</strong> — korrekt und konsistent mit Ihrer Website</li>
                <li><strong>Telefonnummer</strong> — mit Vorwahl, klickbar für Mobil-Nutzer</li>
                <li><strong>Öffnungszeiten</strong> — inklusive Urlaubszeiten und Feiertagen</li>
                <li><strong>Kategorie</strong> — z.B. "Zahnarzt", "Physiotherapeut", "Hausarztpraxis"</li>
                <li><strong>Beschreibung</strong> — 750 Zeichen, Ihre wichtigsten Leistungen</li>
                <li><strong>Fotos</strong> — Praxis, Team, Empfang (regelmäßig aktualisieren)</li>
                <li><strong>Bewertungen</strong> — aktiv um Bewertungen bitten (siehe unten)</li>
            </ul>

            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 my-6">
                <p class="text-amber-800 text-sm"><strong>⚠️ DACH-Hinweis:</strong> In der Schweiz ist Google ebenfalls dominant, aber lokale Plattformen wie local.ch und search.ch sind ebenfalls relevant. In Österreich ist Herold ein wichtiges Verzeichnis.</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-4">Schritt 2: On-Page SEO — Ihre Website optimieren</h2>
            <p>On-Page SEO bedeutet: Die Inhalte und technischen Elemente Ihrer Website so gestalten, dass Google sie richtig versteht und einordnen kann.</p>

            <h3 class="text-xl font-semibold text-gray-900 mt-8 mb-3">Meta-Titel und Meta-Beschreibungen</h3>
            <p>Jeder Seite einen einzigartigen Meta-Titel mit Branche + Ort:</p>
            <ul class="list-disc list-inside space-y-1 mt-2">
                <li>Startseite: "Zahnarztpraxis Dr. Müller — München | Zahnbehandlungen & Bleaching"</li>
                <li>Leistungsseite: "Implantate bei Dr. Müller — München | Kosten & Ablauf"</li>
                <li>Team-Seite: "Unser Team — Zahnarztpraxis Dr. Müller, München"</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-900 mt-8 mb-3">Überschriften (H1, H2, H3) richtig nutzen</h3>
            <p>Jede Seite sollte eine klare H1-Überschrift haben (die Hauptüberschrift). Darunter H2-Überschnitte und ggf. H3-Unterabschnitte. Die Überschriften sollten Ihre wichtigsten Keywords enthalten.</p>

            <h3 class="text-xl font-semibold text-gray-900 mt-8 mb-3">Schema.org Markup (Strukturierte Daten)</h3>
            <p>Schema.org ist ein Code, der Google hilft, Ihre Inhalte besser zu verstehen. Für Praxen besonders wichtig:</p>
            <ul class="list-disc list-inside space-y-1 mt-2">
                <li><strong>MedicalBusiness</strong> oder <strong>Physician</strong> — für die Praxis</li>
                <li><strong>LocalBusiness</strong> — für lokale Sichtbarkeit</li>
                <li><strong>Review</strong> — für Bewertungssterne in den Suchergebnissen</li>
            </ul>
            <p class="mt-2">Wenn Sie WordPress nutzen, helfen Plugins wie Yoast SEO oder Rank Math. Für andere Systeme kann Ihr Webentwickler das Markup einbauen.</p>

            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-4">Schritt 3: Content — Nützliche Inhalte für Patienten</h2>
            <p>Google belohnt Websites, die nützliche, einzigartige Inhalte bieten. Für Praxen bedeutet das:</p>

            <h3 class="text-xl font-semibold text-gray-900 mt-8 mb-3">Blog-Artikel und Ratgeber</h3>
            <p>Beantworten Sie Fragen, die Patienten häufig stellen:</p>
            <ul class="list-disc list-inside space-y-1 mt-2">
                <li>"Was kostet eine Zahnimplantat-Behandlung in Deutschland?"</li>
                <li>"Wann zum Physiotherapeuten? — 5 Warnzeichen"</li>
                <li>"Hautarzt oder Dermatologe — wo der Unterschied?"</li>
                <li>"Kassenleistung oder IGeL? — Was Sie wissen sollten"</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-900 mt-8 mb-3">FAQ-Seite</h3>
            <p>Eine Seite mit häufigen Fragen und Antworten hilft Patienten und Google. Nutzen Sie dafür auch Schema.org FAQ-Markup — das kann dazu führen, dass Ihre Antworten direkt in den Google-Suchergebnissen erscheinen.</p>

            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-4">Schritt 4: Bewertungen aktiv managen</h2>
            <p>Bewertungen sind das Wort der mündlich des Internets. Für Praxen besonders wichtig:</p>
            <ul class="list-disc list-inside space-y-2 mt-2">
                <li><strong>Bitten Sie aktiv um Bewertungen:</strong> Am besten direkt nach dem Termin, per SMS oder E-Mail mit Link</li>
                <li><strong>Antworten Sie auf Bewertungen:</strong> Sowohl positive als auch negative — professionell und freundlich</li>
                <li><strong>Mindestens 10 Google-Bewertungen:</strong> Erst dann wird Google ernsthaft lokale Sichtbarkeit gewährleisten</li>
            </ul>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 my-6">
                <p class="text-blue-800 text-sm"><strong>📌 DSGVO-Hinweis:</strong> Bewertungen mit Patientenbedarfen dürfen nur mit Einwilligung verwendet werden. Fragen Sie immer um Erlaubnis, bevor Sie Zitate auf Ihrer Website nutzen.</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-4">Schritt 5: Technische SEO-Grundlagen</h2>
            <p>Die technischen Basics, die Google erwartet:</p>
            <ul class="list-disc list-inside space-y-2 mt-2">
                <li><strong>HTTPS:</strong> Sichere Verbindung — kein "Nicht sicher"-Warnhinweis</li>
                <li><strong>Mobile-First:</strong> Ihre Website muss auf dem Smartphone perfekt funktionieren</li>
                <li><strong>Ladezeit:</strong> Unter 3 Sekunden — komprimieren Sie Bilder, nutzen Sie Caching</li>
                <li><strong>XML-Sitemap:</strong> Eine Sitemap-Datei, die Google alle Ihre Seiten zeigt</li>
                <li><strong>Robots.txt:</strong> Damit Google weiß, welche Seiten es crawlen darf</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-4">DACH-spezifische Besonderheiten</h2>

            <h3 class="text-xl font-semibold text-gray-900 mt-8 mb-3">Deutschland</h3>
            <ul class="list-disc list-inside space-y-1">
                <li>Google-Marktanteil: ~90%</li>
                <li>Wichtige Verzeichnisse: Jameda, Doctolib, Gelbe Seiten</li>
                <li>Besonderheit: Kassenärztliche Vereinigungen (KV) haben eigene Arztsuchen</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-900 mt-8 mb-3">Österreich</h3>
            <ul class="list-disc list-inside space-y-1">
                <li>Google-Marktanteil: ~85%</li>
                <li>Wichtige Verzeichnisse: Herold, Das Örtliche, Arztliste.at</li>
                <li>Besonderheit: ELGA (elektronische Gesundheitsakte) wird zunehmend relevant</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-900 mt-8 mb-3">Schweiz</h3>
            <ul class="list-disc list-inside space-y-1">
                <li>Google-Marktanteil: ~95%</li>
                <li>Wichtige Verzeichnisse: local.ch, search.ch, Tel.search</li>
                <li>Besonderheit: Mehrsprachigkeit (DE/FR/IT) kann Vorteile bringen</li>
            </ul>

            <!-- Zusammenfassung -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 my-10">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO-Checkliste für Praxen 2026</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> Google Business Profile eingerichtet und verifiziert</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> Meta-Titel mit Branche + Ort für jede Seite</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> Meta-Beschreibungen für jede Seite</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> Klare Überschriftenstruktur (H1, H2, H3)</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> Schema.org Markup (LocalBusiness / MedicalBusiness)</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> Mindestens 10 Google-Bewertungen</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> Regelmäßige Blog-Artikel (mind. 1x pro Monat)</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> FAQ-Seite mit Schema.org Markup</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> HTTPS aktiv</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> Mobile-First Design</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> Ladezeit unter 3 Sekunden</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> XML-Sitemap bei Google Search Console hinterlegt</li>
                    <li class="flex items-start gap-2"><span class="text-indigo-600 font-bold">☐</span> In lokalen Verzeichnissen eingetragen (Jameda, Herold, local.ch)</li>
                </ul>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-4">Fazit: SEO ist kein Projekt, sondern ein Prozess</h2>
            <p>SEO für Ärzte und Therapeuten ist kein einmaliges Projekt. Google aktualisiert ständig seine Algorithmen, die Konkurrenz arbeitet an ihrer Sichtbarkeit, und Patientenverhalten verändert sich. Aber die Grundlagen bleiben: eine schnelle, mobile Website, ein gepflegtes Google Business Profile, nützliche Inhalte und echte Patientenbewertungen.</p>
            <p>Beginnen Sie heute mit dem Einfachen — und bauen Sie nach und nach auf.</p>

            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6 mt-10">
                <h3 class="text-lg font-semibold text-indigo-900 mb-2">Ihre SEO-Basis testen</h3>
                <p class="text-indigo-800 text-sm">Unser <a href="/" class="font-medium underline">kostenloser Website-Check</a> analysiert die technischen SEO-Grundlagen Ihrer Praxis-Website: Ladezeit, Mobile-Darstellung, Meta-Tags, HTTPS und mehr. Ergebnis in 30 Sekunden.</p>
            </div>
        </div>
    </article>

    <!-- Verwandte Artikel -->
    <div class="mt-12 border-t border-gray-200 pt-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Weitere Artikel</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('blog.show', 'raende-patienten-verliert') }}" class="block border border-gray-200 rounded-lg p-4 hover:border-indigo-300 transition">
                <p class="text-sm font-medium text-gray-900">10 Gründe warum Ihre Praxis-Website Patienten verliert</p>
                <p class="text-xs text-gray-500 mt-1">Patientenakquise & Website</p>
            </a>
            <a href="{{ route('blog.show', 'professionelle-praxis-seiten') }}" class="block border border-gray-200 rounded-lg p-4 hover:border-indigo-300 transition">
                <p class="text-sm font-medium text-gray-900">Website-Check: So sehen professionelle Praxis-Seiten aus</p>
                <p class="text-xs text-gray-500 mt-1">Webdesign & Best Practices</p>
            </a>
        </div>
    </div>

    <!-- CTA Box -->
    <div class="mt-12 bg-gray-900 rounded-xl p-8 text-center">
        <h3 class="text-xl font-bold text-white mb-3">Website kostenlos prüfen</h3>
        <p class="text-gray-400 mb-6 text-sm">Testen Sie die SEO-Grundlagen Ihrer Praxis-Website — kostenlos und ohne Anmeldung.</p>
        <a href="/" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition">Jetzt Website prüfen →</a>
    </div>
</div>
@endsection
