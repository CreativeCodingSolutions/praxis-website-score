@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📋 Leads <span class="text-muted fs-5">({{ $stats['total'] }} gesamt)</span></h2>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center p-3">
                <div class="text-muted">Gesamt</div>
                <div class="fs-2 fw-bold text-primary">{{ $stats['total'] }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3">
                <div class="text-muted">Diese Woche</div>
                <div class="fs-2 fw-bold text-success">{{ $stats['this_week'] }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3">
                <div class="text-muted">Neu</div>
                <div class="fs-2 fw-bold text-warning">{{ $stats['new'] }}</div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Website</th>
                        <th>Score</th>
                        <th>Status</th>
                        <th>Eingang</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                    <tr>
                        <td>{{ $lead->name }}</td>
                        <td><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></td>
                        <td><a href="{{ $lead->website_url }}" target="_blank">{{ Str::limit($lead->website_url, 30) }}</a></td>
                        <td>
                            @if($lead->score !== null)
                                <span class="badge {{ $lead->score >= 70 ? 'bg-success' : ($lead->score >= 40 ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $lead->score }}/100
                                </span>
                            @else
                                <span class="badge bg-secondary">—</span>
                            @endif
                        </td>
                        <td><span class="badge bg-{{ $lead->status === 'new' ? 'info' : 'primary' }}">{{ $lead->status }}</span></td>
                        <td>{{ $lead->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <a href="{{ route('leads.show', $lead) }}" class="btn btn-sm btn-outline-primary">Details</a>
                            <form method="POST" action="{{ route('leads.destroy', $lead) }}" class="d-inline" onsubmit="return confirm('Löschen?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">✕</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Noch keine Leads vorhanden.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $leads->links() }}</div>
</div>
@endsection
