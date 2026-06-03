@extends('layouts.app')
@section('title', 'API Keys — Praxis Website Score')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold">API Keys</h1>
            <p class="text-gray-500">Verwalte deine API-Zugänge für die Website Score API.</p>
        </div>
    </div>

    <!-- Create Key -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">Neuen API-Key erstellen</h2>
        <form action="{{ route('apikeys.store') }}" method="POST" class="flex gap-3">
            @csrf
            <input type="text" name="name" required placeholder="Key Name (z.B. Website-Integration)" class="flex-1 px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-indigo-700">Erstellen</button>
        </form>
    </div>

    <!-- Key List -->
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="text-lg font-semibold mb-4">Deine API Keys</h2>
        @if($apiKeys->isEmpty())
            <p class="text-gray-400 text-center py-8">Noch keine API Keys erstellt.</p>
        @else
            <table class="w-full text-sm">
                <thead><tr class="text-left text-gray-500 border-b"><th class="pb-3">Name</th><th class="pb-3">Key</th><th class="pb-3">Erstellt</th><th class="pb-3"></th></tr></thead>
                <tbody>
                @foreach($apiKeys as $key)
                <tr class="border-t">
                    <td class="py-3 font-medium">{{ $key->name }}</td>
                    <td class="py-3 font-mono text-gray-500">{{ $key->plain_preview ?? '****' }}</td>
                    <td class="py-3 text-gray-400">{{ $key->created_at?->format('d.m.Y') }}</td>
                    <td class="py-3 text-right">
                        <form method="POST" action="{{ route('apikeys.destroy', $key->id) }}">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600 text-sm">Widerrufen</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
