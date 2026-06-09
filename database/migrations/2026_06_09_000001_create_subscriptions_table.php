<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Extend users table with Stripe fields
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'stripe_id')) {
                $table->string('stripe_id')->nullable()->after('password')->index();
            }
            if (!Schema::hasColumn('users', 'stripe_status')) {
                $table->string('stripe_status')->nullable()->after('stripe_id');
            }
            if (!Schema::hasColumn('users', 'plan')) {
                $table->string('plan')->default('free')->after('stripe_status');
            }
            if (!Schema::hasColumn('users', 'trial_ends_at')) {
                $table->timestamp('trial_ends_at')->nullable()->after('plan');
            }
            if (!Schema::hasColumn('users', 'plan_ends_at')) {
                $table->timestamp('plan_ends_at')->nullable()->after('trial_ends_at');
            }
        });

        // Create subscriptions table
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('stripe_id')->unique();
            $table->string('stripe_price')->nullable();
            $table->string('plan')->default('free');  // free, pro, business
            $table->string('stripe_status')->default('active');
            $table->integer('quantity')->default(1);
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('current_period_start')->nullable();
            $table->timestamp('current_period_end')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'stripe_status']);
            $table->index(['stripe_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'stripe_id',
                'stripe_status',
                'plan',
                'trial_ends_at',
                'plan_ends_at',
            ]);
        });
    }
};
