<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ensure leads table exists with all required columns
        if (!Schema::hasTable('leads')) {
            Schema::create('leads', function (Blueprint $table) {
                $table->id();
                $table->foreignId('guest_report_id')->nullable()->constrained()->nullOnDelete();
                $table->string('email');
                $table->string('name')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->boolean('consent_given')->default(false);
                $table->text('consent_text')->nullable();
                $table->string('source')->default('pws_landing');
                $table->string('website_url', 500)->nullable();
                $table->tinyInteger('score')->nullable();
                $table->string('status', 20)->default('new');
                $table->timestamps();

                $table->index('email');
                $table->index('source');
                $table->index('created_at');
            });
        } else {
            // Add missing columns
            if (!Schema::hasColumn('leads', 'source')) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->string('source')->default('pws_landing')->after('consent_text');
                });
            }
            if (!Schema::hasColumn('leads', 'guest_report_id')) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->foreignId('guest_report_id')->nullable()->after('id')->constrained()->nullOnDelete();
                });
            }
            if (!Schema::hasColumn('leads', 'consent_given')) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->boolean('consent_given')->default(false)->after('ip_address');
                });
            }
            if (!Schema::hasColumn('leads', 'consent_text')) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->text('consent_text')->nullable()->after('consent_given');
                });
            }
            if (!Schema::hasColumn('leads', 'website_url')) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->string('website_url', 500)->nullable()->after('source');
                });
            }
            if (!Schema::hasColumn('leads', 'score')) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->tinyInteger('score')->nullable()->after('website_url');
                });
            }
            if (!Schema::hasColumn('leads', 'status')) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->string('status', 20)->default('new')->after('score');
                });
            }
            // Add source index if not exists
            if (!Schema::hasIndex('leads', 'leads_source_index')) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->index('source');
                });
            }
        }
    }

    public function down(): void
    {
        // No rollback — this is an additive migration
    }
};
