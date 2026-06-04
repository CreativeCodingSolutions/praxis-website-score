<?php
namespace App\Modules\AppointmentBooking\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BookingPageController extends Controller {
    public function show($slug) {
        $user = DB::table('users')->where('booking_slug', $slug)->first();
        if (!$user) abort(404);
        $availableSlots = $this->generateSlots($user->id);
        return view('appointment-booking.book', compact('user', 'availableSlots', 'slug'));
    }
    public function submit(Request $request, $slug) {
        $user = DB::table('users')->where('booking_slug', $slug)->first();
        if (!$user) abort(404);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'message' => 'nullable|string|max:500',
        ]);
        DB::table('appointments')->insert([
            'user_id' => $user->id,
            'title' => 'Termin: ' . $validated['name'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'duration' => 30,
            'description' => $validated['message'] ?? '',
            'guest_name' => $validated['name'],
            'guest_email' => $validated['email'],
            'guest_phone' => $validated['phone'] ?? '',
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('booking.page', $slug)->with('success', 'Terminanfrage gesendet! Sie erhalten eine Bestätigung.');
    }
    private function generateSlots($userId) {
        $slots = [];
        for ($day = 0; $day < 14; $day++) {
            $date = now()->addDays($day)->format('Y-m-d');
            $dayOfWeek = now()->addDays($day)->dayOfWeek;
            if ($dayOfWeek === 0 || $dayOfWeek === 6) continue; // Skip weekends
            for ($hour = 9; $hour < 17; $hour++) {
                $time = sprintf('%02d:00', $hour);
                $exists = DB::table('appointments')->where('user_id', $userId)->where('date', $date)->where('time', $time)->where('status', '!=', 'cancelled')->exists();
                if (!$exists) $slots[$date][] = $time;
            }
        }
        return $slots;
    }
}
