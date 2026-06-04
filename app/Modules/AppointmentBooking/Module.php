<?php
namespace App\Modules\AppointmentBooking;
class Module {
    public static function getName(): string { return 'Terminbuchung'; }
    public static function getDescription(): string { return 'Online-Terminbuchung für Praxen — Kalender, Slots, Bestätigungen'; }
    public static function getVersion(): string { return '1.0.0'; }
    public static function isEnabled(): bool { return env('FEATURE_APPOINTMENT_BOOKING', false); }
    public static function getIcon(): string { return 'fa-solid fa-calendar-check'; }
    public static function getPriority(): int { return 60; }
}
