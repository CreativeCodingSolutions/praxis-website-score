@extends('layouts.app')
@section('title', 'Team — Praxis Website Score')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold">Team Management</h1>
            <p class="text-gray-500">Lade Team-Mitglieder ein und verwalte deren Berechtigungen.</p>
        </div>
    </div>

    <!-- Invite Form -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">Mitglied einladen</h2>
        <form action="{{ route('team.invite') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="email" name="email" required placeholder="email@beispiel.de" class="flex-1 px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
            <select name="role" class="px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none">
                <option value="member">Mitglied</option>
                <option value="admin">Admin</option>
                <option value="viewer">Betrachter</option>
            </select>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition">Einladen</button>
        </form>
    </div>

    <!-- Members List -->
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="text-lg font-semibold mb-4">Team Mitglieder</h2>
        @if($members->isEmpty())
            <p class="text-gray-400 text-center py-8">Noch keine Team-Mitglieder eingeladen.</p>
        @else
            <table class="w-full text-sm">
                <thead><tr class="text-left text-gray-500 border-b"><th class="pb-3">Email</th><th class="pb-3">Rolle</th><th class="pb-3">Status</th><th class="pb-3"></th></tr></thead>
                <tbody>
                @foreach($members as $member)
                <tr class="border-t">
                    <td class="py-3 font-medium">{{ $member->email }}</td>
                    <td class="py-3">
                        <form method="POST" action="{{ route('team.role', $member->id) }}" class="inline">
                            @csrf @method('PATCH')
                            <select name="role" onchange="this.form.submit()" class="text-sm border rounded px-2 py-1">
                                <option value="admin" {{ $member->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="member" {{ $member->role === 'member' ? 'selected' : '' }}>Mitglied</option>
                                <option value="viewer" {{ $member->role === 'viewer' ? 'selected' : '' }}>Betrachter</option>
                            </select>
                        </form>
                    </td>
                    <td class="py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-bold {{ $member->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ $member->status }}</span>
                    </td>
                    <td class="py-3 text-right">
                        <form method="POST" action="{{ route('team.remove', $member->id) }}">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600 text-sm">Entfernen</button>
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
