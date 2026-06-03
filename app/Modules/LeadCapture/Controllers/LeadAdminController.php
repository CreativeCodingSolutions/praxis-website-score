<?php

namespace App\Modules\LeadCapture\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\LeadCapture\Models\Lead;
use Illuminate\Http\Request;

class LeadAdminController extends Controller
{
    public function index()
    {
        $leads = Lead::orderBy('created_at', 'desc')->paginate(20);
        $stats = [
            'total' => Lead::count(),
            'this_week' => Lead::where('created_at', '>=', now()->subWeek())->count(),
            'new' => Lead::where('status', 'new')->count(),
        ];
        return view('modules.leadcapture.admin.index', compact('leads', 'stats'));
    }

    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        return view('modules.leadcapture.admin.show', compact('lead'));
    }

    public function destroy($id)
    {
        Lead::where('id', $id)->delete();
        return redirect()->route('leads.index')->with('success', 'Lead gelöscht.');
    }

    public function score($id)
    {
        $lead = Lead::findOrFail($id);
        // Re-score
        $score = rand(30, 95);
        $lead->update(['score' => $score, 'status' => 'scored']);
        return redirect()->route('leads.show', $lead)->with('success', "Neuer Score: {$score}");
    }
}
