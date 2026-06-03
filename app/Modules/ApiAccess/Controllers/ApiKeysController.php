<?php

namespace App\Modules\ApiAccess\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiKeysController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $user = Auth::user();
        $apiKeys = $user->tokens ?? collect();
        return view('apiaccess.index', compact('apiKeys'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        // In a real app, this would use Laravel Sanctum or Passport
        // For now, we store a simple token record
        \DB::table('api_tokens')->insert([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'token' => hash('sha256', $plainTextToken = Str::random(40)),
            'plain_preview' => substr($plainTextToken, 0, 8) . '...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'API-Key erstellt. Notiere den Key — er wird nicht erneut angezeigt.');
    }

    public function destroy($id)
    {
        \DB::table('api_tokens')->where('id', $id)->where('user_id', Auth::id())->delete();
        return back()->with('success', 'API-Key widerrufen.');
    }
}
