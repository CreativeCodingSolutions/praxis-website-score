<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('leads')) {
            Schema::create('leads', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('email');
                $table->string('website_url', 500);
                $table->tinyInteger('score')->nullable();
                $table->string('status', 20)->default('new');
                $table->timestamps();
                $table->index('email');
                $table->index('status');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
