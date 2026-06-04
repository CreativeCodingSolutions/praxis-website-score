<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termin bearbeiten — Praxis Website Score</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fa-solid fa-pen-to-square me-2"></i>Termin bearbeiten</h4>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('appointments.update', $appointment->id) }}">
                            @csrf @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Titel <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $appointment->title) }}" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date" class="form-label fw-bold">Datum <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $appointment->date) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="time" class="form-label fw-bold">Uhrzeit <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="time" name="time" value="{{ old('time', $appointment->time) }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label fw-bold">Dauer <span class="text-danger">*</span></label>
                                <select class="form-select" id="duration" name="duration" required>
                                    <option value="15" {{ old('duration', $appointment->duration) == 15 ? 'selected' : '' }}>15 Minuten</option>
                                    <option value="30" {{ old('duration', $appointment->duration) == 30 ? 'selected' : '' }}>30 Minuten</option>
                                    <option value="45" {{ old('duration', $appointment->duration) == 45 ? 'selected' : '' }}>45 Minuten</option>
                                    <option value="60" {{ old('duration', $appointment->duration) == 60 ? 'selected' : '' }}>60 Minuten</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Beschreibung</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $appointment->description) }}</textarea>
                            </div>
                            <div class="mb-4">
                                <span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning text-dark' : ($appointment->status === 'cancelled' ? 'danger' : 'secondary')) }}">
                                    Status: {{ $appointment->status === 'confirmed' ? 'Bestätigt' : ($appointment->status === 'pending' ? 'Ausstehend' : ($appointment->status === 'cancelled' ? 'Storniert' : 'Abgeschlossen')) }}
                                </span>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-save me-1"></i> Änderungen speichern
                                </button>
                                <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary">Abbrechen</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
