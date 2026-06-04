<?php
namespace App\Modules\AppointmentBooking\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AppointmentController extends Controller {
    public function index() {
        $appointments = DB::table('appointments')->where('user_id', auth()->id())
            ->orderBy('date', 'desc')->orderBy('time', 'asc')->paginate(15);
        $stats = [
            'total' => DB::table('appointments')->where('user_id', auth()->id())->count(),
            'confirmed' => DB::table('appointments')->where('user_id', auth()->id())->where('status', 'confirmed')->count(),
            'pending' => DB::table('appointments')->where('user_id', auth()->id())->where('status', 'pending')->count(),
            'cancelled' => DB::table('appointments')->where('user_id', auth()->id())->where('status', 'cancelled')->count(),
        ];
        return view('appointment-booking.index', compact('appointments', 'stats'));
    }
    public function create() {
        return view('appointment-booking.create');
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|in:15,30,45,60',
            'description' => 'nullable|string|max:500',
        ]);
        DB::table('appointments')->insert([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'duration' => $validated['duration'],
            'description' => $validated['description'] ?? '',
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('appointments.index')->with('success', 'Termin erstellt!');
    }
    public function edit($id) {
        $appointment = DB::table('appointments')->where('id', $id)->where('user_id', auth()->id())->first();
        if (!$appointment) abort(404);
        return view('appointment-booking.edit', compact('appointment'));
    }
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|in:15,30,45,60',
            'description' => 'nullable|string|max:500',
        ]);
        DB::table('appointments')->where('id', $id)->where('user_id', auth()->id())->update(
            array_merge($validated, ['updated_at' => now()])
        );
        return redirect()->route('appointments.index')->with('success', 'Termin aktualisiert!');
    }
    public function destroy($id) {
        DB::table('appointments')->where('id', $id)->where('user_id', auth()->id())->delete();
        return redirect()->route('appointments.index')->with('success', 'Termin gelöscht.');
    }
    public function confirm($id) {
        DB::table('appointments')->where('id', $id)->where('user_id', auth()->id())->update(['status' => 'confirmed', 'updated_at' => now()]);
        return redirect()->route('appointments.index')->with('success', 'Termin bestätigt!');
    }
    public function cancel($id) {
        DB::table('appointments')->where('id', $id)->where('user_id', auth()->id())->update(['status' => 'cancelled', 'updated_at' => now()]);
        return redirect()->route('appointments.index')->with('success', 'Termin storniert.');
    }
}
