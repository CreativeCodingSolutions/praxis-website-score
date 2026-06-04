<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminbuchung — Praxis Website Score</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0"><i class="fa-solid fa-calendar-check text-primary me-2"></i>Terminbuchung</h2>
            <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-1"></i> Neuer Termin
            </a>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <!-- Stats Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-list-check fa-2x text-primary mb-2"></i>
                        <h3 class="mb-0">{{ $stats['total'] }}</h3>
                        <small class="text-muted">Gesamt</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-check-circle fa-2x text-success mb-2"></i>
                        <h3 class="mb-0">{{ $stats['confirmed'] }}</h3>
                        <small class="text-muted">Bestätigt</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-clock fa-2x text-warning mb-2"></i>
                        <h3 class="mb-0">{{ $stats['pending'] }}</h3>
                        <small class="text-muted">Ausstehend</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-ban fa-2x text-danger mb-2"></i>
                        <h3 class="mb-0">{{ $stats['cancelled'] }}</h3>
                        <small class="text-muted">Storniert</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointments Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Titel</th>
                                <th>Datum</th>
                                <th>Zeit</th>
                                <th>Dauer</th>
                                <th>Gast</th>
                                <th>Status</th>
                                <th class="text-end">Aktionen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appointment)
                            <tr>
                                <td><strong>{{ $appointment->title }}</strong></td>
                                <td>{{ \Carbon\Carbon::parse($appointment->date)->format('d.m.Y') }}</td>
                                <td>{{ $appointment->time }}</td>
                                <td>{{ $appointment->duration }} min</td>
                                <td>
                                    @if($appointment->guest_name)
                                        <small><i class="fa-solid fa-user me-1"></i>{{ $appointment->guest_name }}</small>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @switch($appointment->status)
                                        @case('confirmed')<span class="badge bg-success">Bestätigt</span>@break
                                        @case('pending')<span class="badge bg-warning text-dark">Ausstehend</span>@break
                                        @case('cancelled')<span class="badge bg-danger">Storniert</span>@break
                                        @case('completed')<span class="badge bg-secondary">Abgeschlossen</span>@break
                                    @endswitch
                                </td>
                                <td class="text-end">
                                    @if($appointment->status === 'pending')
                                        <form method="POST" action="{{ route('appointments.confirm', $appointment->id) }}" class="d-inline">
                                            @csrf<button class="btn btn-sm btn-outline-success" title="Bestätigen"><i class="fa-solid fa-check"></i></button>
                                        </form>
                                        <form method="POST" action="{{ route('appointments.cancel', $appointment->id) }}" class="d-inline">
                                            @csrf<button class="btn btn-sm btn-outline-warning" title="Stornieren"><i class="fa-solid fa-ban"></i></button>
                                        </form>
                                    @endif
                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-outline-primary" title="Bearbeiten"><i class="fa-solid fa-pen"></i></a>
                                    <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" class="d-inline" onsubmit="return confirm('Termin wirklich löschen?')">
                                        @csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" title="Löschen"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa-regular fa-calendar-xmark fa-3x mb-3 d-block"></i>
                                    Noch keine Termine vorhanden.<br>
                                    <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-sm mt-3">Ersten Termin erstellen</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $appointments->links() }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
