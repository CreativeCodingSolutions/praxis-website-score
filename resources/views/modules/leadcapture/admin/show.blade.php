@extends('layouts.app')

@section('content')
<div class="container py-4">
    <a href="{{ route('leads.index') }}" class="btn btn-outline-secondary mb-3">← Zurück zur Liste</a>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header"><h4 class="mb-0">Lead Details</h4></div>
                <div class="card-body">
                    <table class="table">
                        <tr><th>Name</th><td>{{ $lead->name }}</td></tr>
                        <tr><th>E-Mail</th><td><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></td></tr>
                        <tr><th>Website</th><td><a href="{{ $lead->website_url }}" target="_blank">{{ $lead->website_url }}</a></td></tr>
                        <tr><th>Score</th>
                            <td>
                                @if($lead->score !== null)
                                    <span class="badge {{ $lead->score >= 70 ? 'bg-success' : ($lead->score >= 40 ? 'bg-warning' : 'bg-danger') }} fs-6">
                                        {{ $lead->score }}/100
                                    </span>
                                @else
                                    <span class="badge bg-secondary">Noch nicht bewertet</span>
                                @endif
                            </td>
                        </tr>
                        <tr><th>Status</th><td><span class="badge bg-primary">{{ $lead->status }}</span></td></tr>
                        <tr><th>Eingang</th><td>{{ $lead->created_at->format('d.m.Y H:i') }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h5>Aktionen</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('leads.score', $lead) }}" class="mb-2">
                        @csrf
                        <button class="btn btn-outline-primary w-100">🔄 Neu bewerten</button>
                    </form>
                    <form method="POST" action="{{ route('leads.destroy', $lead) }}" onsubmit="return confirm('Lead wirklich löschen?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger w-100">🗑️ Löschen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
