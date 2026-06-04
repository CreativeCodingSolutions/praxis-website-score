<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->date('date');
            $table->time('time');
            $table->unsignedSmallInteger('duration')->default(30);
            $table->text('description')->nullable();
            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();
            $table->string('guest_phone')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->timestamps();
            $table->index(['user_id', 'date']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('booking_slug')->nullable()->unique()->after('email');
        });
    }
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('booking_slug');
        });
        Schema::dropIfExists('appointments');
    }
};
