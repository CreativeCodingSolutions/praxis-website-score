<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('guest_reports')) {
            Schema::create('guest_reports', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();
                $table->string('url');
                $table->string('domain')->nullable();
                $table->string('industry')->default('general');
                $table->unsignedTinyInteger('overall_score')->default(0);
                $table->json('category_scores')->nullable();
                $table->json('recommendations')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->boolean('lead_captured')->default(false);
                $table->timestamps();

                $table->index('uuid');
                $table->index('created_at');
            });
        }

        // Only create leads table if it doesn't exist, otherwise add columns
        if (!Schema::hasTable('leads')) {
            Schema::create('leads', function (Blueprint $table) {
                $table->id();
                $table->foreignId('guest_report_id')->nullable()->constrained()->nullOnDelete();
                $table->string('email');
                $table->string('name')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->boolean('consent_given')->default(false);
                $table->text('consent_text')->nullable();
                $table->string('source')->default('guest_score');
                $table->timestamps();

                $table->index('email');
                $table->index('created_at');
            });
        } else {
            // Add guest_report_id column if missing
            if (!Schema::hasColumn('leads', 'guest_report_id')) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->foreignId('guest_report_id')->nullable()->after('id')->constrained()->nullOnDelete();
                });
            }
            if (!Schema::hasColumn('leads', 'consent_given')) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->boolean('consent_given')->default(false)->after('ip_address');
                    $table->text('consent_text')->nullable()->after('consent_given');
                    $table->string('source')->default('guest_score')->after('consent_text');
                });
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
        Schema::dropIfExists('guest_reports');
    }
};
