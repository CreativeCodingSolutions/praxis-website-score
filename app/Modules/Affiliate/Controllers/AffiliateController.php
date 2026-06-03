<?php

namespace App\Modules\Affiliate\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AffiliateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $referralCode = $user->affiliate_code ?? $this->generateCode($user);

        $stats = [
            'referrals' => rand(0, 50), // placeholder — real impl would query a referrals table
            'clicks' => rand(0, 200),
            'conversions' => rand(0, 10),
            'earnings' => rand(0, 500),
        ];

        return view('affiliate.dashboard', compact('referralCode', 'stats'));
    }

    public function generate(Request $request)
    {
        $user = Auth::user();
        $user->update(['affiliate_code' => $this->generateCode($user)]);
        return back()->with('success', 'Neuer Affiliate-Code generiert.');
    }

    private function generateCode($user): string
    {
        return strtoupper(substr(md5($user->id . $user->email), 0, 8));
    }
}
