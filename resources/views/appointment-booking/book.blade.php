<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termin buchen — {{ $user->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; }
        .booking-card { background: rgba(255,255,255,0.97); border-radius: 16px; padding: 2.5rem; max-width: 680px; margin: 3rem auto; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .slot-btn { border-radius: 8px; margin: 3px; font-size: 0.9rem; }
        .slot-btn:hover { transform: scale(1.05); }
        .date-header { background: #f0f0f8; border-radius: 8px; padding: 8px 16px; margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="booking-card">
        <div class="text-center mb-4">
            <i class="fa-solid fa-calendar-check fa-3x text-primary mb-2"></i>
            <h2 class="mb-1">Termin buchen</h2>
            <p class="text-muted mb-0">{{ $user->name }}</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('booking.submit', $slug) }}" id="bookingForm">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label class="form-label fw-bold">Dein Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Max Mustermann" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">E-Mail <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="max@beispiel.de" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Telefon</label>
                <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="0123 456789">
            </div>

            <hr>
            <h5 class="mb-3"><i class="fa-regular fa-clock me-1"></i>Verfügbare Termine</h5>

            @if(empty($availableSlots))
                <div class="alert alert-info">Leider sind in den nächsten 14 Tagen keine Slots verfügbar.</div>
            @else
                <div class="accordion mb-3" id="slotAccordion">
                    @foreach($availableSlots as $date => $times)
                        @php
                            $dateObj = \Carbon\Carbon::parse($date);
                            $dateFormatted = $dateObj->locale('de')->isoFormat('dddd, DD.MM.YYYY');
                            $collapseId = 'collapse_' . str_replace('-', '_', $date);
                        @endphp
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}">
                                    <i class="fa-regular fa-calendar me-2"></i>{{ $dateFormatted }}
                                    <span class="badge bg-primary ms-2">{{ count($times) }} Slots</span>
                                </button>
                            </h2>
                            <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#slotAccordion">
                                <div class="accordion-body">
                                    <div class="d-flex flex-wrap">
                                        @foreach($times as $time)
                                            <div class="form-check">
                                                <input class="form-check-input d-none" type="radio" name="time" id="slot_{{ $date }}_{{ str_replace(':', '', $time) }}" value="{{ $time }}" required>
                                                <label class="btn btn-outline-primary slot-btn" for="slot_{{ $date }}_{{ str_replace(':', '', $time) }}" onclick="selectSlot(this, '{{ $date }}')">
                                                    {{ $time }} Uhr
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="date" id="selectedDate" value="">
            @endif

            <div class="mb-4">
                <label class="form-label fw-bold">Nachricht / Anliegen</label>
                <textarea class="form-control" name="message" rows="2" placeholder="Optional: Beschreibe kurz dein Anliegen...">{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100" id="submitBtn" disabled>
                <i class="fa-solid fa-paper-plane me-1"></i> Terminanfrage senden
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectSlot(el, date) {
            document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('btn-primary', 'active'));
            document.querySelectorAll('.slot-btn').forEach(b => b.classList.add('btn-outline-primary'));
            el.classList.remove('btn-outline-primary');
            el.classList.add('btn-primary', 'active');
            document.getElementById('selectedDate').value = date;
            document.getElementById('submitBtn').disabled = false;
        }
    </script>
</body>
</html>
