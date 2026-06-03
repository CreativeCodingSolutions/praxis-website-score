<?php

namespace App\Modules\WhiteLabel\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WhiteLabelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $settings = DB::table('whitelabel_settings')
            ->where('user_id', Auth::id())
            ->first();

        return view('whitelabel.index', compact('settings'));
    }

    public function saveSettings(Request $request)
    {
        $request->validate([
            'brand_name' => 'nullable|string|max:255',
            'custom_domain' => 'nullable|string|max:255',
            'primary_color' => 'nullable|string|max:7',
            'accent_color' => 'nullable|string|max:7',
            'email_from' => 'nullable|email|max:255',
            'email_reply_to' => 'nullable|email|max:255',
        ]);

        $data = [
            'brand_name' => $request->input('brand_name', ''),
            'custom_domain' => $request->input('custom_domain', ''),
            'primary_color' => $request->input('primary_color', '#4f46e5'),
            'accent_color' => $request->input('accent_color', '#818cf8'),
            'email_from' => $request->input('email_from', ''),
            'email_reply_to' => $request->input('email_reply_to', ''),
            'updated_at' => now(),
        ];

        $existing = DB::table('whitelabel_settings')
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            DB::table('whitelabel_settings')
                ->where('user_id', Auth::id())
                ->update($data);
        } else {
            $data['user_id'] = Auth::id();
            $data['created_at'] = now();
            DB::table('whitelabel_settings')->insert($data);
        }

        return back()->with('success', 'White-Label Einstellungen gespeichert.');
    }

    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,svg|max:2048',
        ]);

        $path = $request->file('logo')->store('whitelabel-logos', 'public');

        DB::table('whitelabel_settings')
            ->updateOrInsert(
                ['user_id' => Auth::id()],
                ['logo_path' => $path, 'updated_at' => now()]
            );

        return back()->with('success', 'Logo hochgeladen.');
    }

    public function preview()
    {
        $settings = DB::table('whitelabel_settings')
            ->where('user_id', Auth::id())
            ->first();

        return view('whitelabel.preview', compact('settings'));
    }
}
