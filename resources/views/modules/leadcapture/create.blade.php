<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kostenloses Website-Scoring — Praxis Website Score</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; }
        .capture-card { background: rgba(255,255,255,0.95); border-radius: 16px; padding: 2.5rem; max-width: 520px; margin: 4rem auto; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .score-badge { font-size: 3rem; font-weight: 800; }
    </style>
</head>
<body>
    <div class="capture-card">
        <h2 class="text-center mb-1">🏥 Praxis Website Score</h2>
        <p class="text-muted text-center mb-4">Erhalte einen kostenlosen Website-Score in 30 Sekunden</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('leadcapture.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Dein Name</label>
                <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name') }}" placeholder="Dr. Max Mustermann" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">E-Mail Adresse</label>
                <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" placeholder="info@praxis.de" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Website URL</label>
                <input type="url" name="website_url" class="form-control form-control-lg" value="{{ old('website_url') }}" placeholder="https://www.praxis-muster.de" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="consent" value="1" class="form-check-input" id="consent" required>
                <label class="form-check-label" for="consent" style="font-size: 0.85rem;">
                    Ich bin damit einverstanden, dass meine Daten zur Kontaktaufnahme gespeichert werden.
                    <a href="/datenschutz" target="_blank">Datenschutzerklärung</a>
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100">🚀 Jetzt Score berechnen</button>
        </form>
        <p class="text-muted text-center mt-3 mb-0" style="font-size: 0.85rem;">Keine Kreditkarte · Kein Abo · DSGVO-konform · Quelle: pws_landing</p>
    </div>
</body>
</html>
