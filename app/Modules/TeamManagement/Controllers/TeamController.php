<?php

namespace App\Modules\TeamManagement\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $members = DB::table('team_members')
            ->where('team_owner_id', Auth::id())
            ->get();
        return view('team.index', compact('members'));
    }

    public function invite(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:admin,member,viewer',
        ]);

        DB::table('team_members')->insert([
            'team_owner_id' => Auth::id(),
            'email' => $request->email,
            'role' => $request->role,
            'invite_token' => Str::random(32),
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // In a real app, send invitation email here
        return back()->with('success', 'Einladung an ' . $request->email . ' gesendet.');
    }

    public function remove($id)
    {
        DB::table('team_members')
            ->where('id', $id)
            ->where('team_owner_id', Auth::id())
            ->delete();
        return back()->with('success', 'Mitglied entfernt.');
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate(['role' => 'required|in:admin,member,viewer']);
        DB::table('team_members')
            ->where('id', $id)
            ->where('team_owner_id', Auth::id())
            ->update(['role' => $request->role, 'updated_at' => now()]);
        return back()->with('success', 'Rolle aktualisiert.');
    }
}
