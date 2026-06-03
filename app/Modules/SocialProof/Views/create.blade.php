@extends('layouts.app')

@section('title', 'Testimonial erstellen')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6">Neues Testimonial erstellen</h1>

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('social-proof.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rolle / Titel *</label>
            <input type="text" name="role" id="role" value="{{ old('role') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="text" class="block text-sm font-medium text-gray-700 mb-1">Testimonial Text *</label>
            <textarea name="text" id="text" rows="4" required maxlength="1000"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('text') }}</textarea>
        </div>

        <div class="mb-6">
            <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Bewertung *</label>
            <select name="rating" id="rating" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="5">5 Sterne — Hervorragend</option>
                <option value="4">4 Sterne — Sehr gut</option>
                <option value="3">3 Sterne — Gut</option>
                <option value="2">2 Sterne — Befriedigend</option>
                <option value="1">1 Sterne — Ausreichend</option>
            </select>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Speichern
            </button>
            <a href="{{ route('social-proof.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded hover:bg-gray-300">
                Abbrechen
            </a>
        </div>
    </form>
</div>
@endsection
