<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('plan')->default('free'); // free, pro, business
            $table->integer('reports_limit')->default(1);
            $table->integer('reports_used')->default(0);
            $table->date('plan_expires_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('url');
            $table->string('domain');
            $table->string('industry')->default('general');
            $table->unsignedTinyInteger('overall_score')->default(0);
            $table->json('category_scores')->nullable();
            $table->json('recommendations')->nullable();
            $table->string('pdf_path')->nullable();
            $table->boolean('is_public')->default(false);
            $table->timestamps();
            $table->index(['user_id', 'created_at']);
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
