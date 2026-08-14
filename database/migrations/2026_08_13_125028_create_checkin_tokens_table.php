<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(config('checkin.table', 'checkin_tokens'), function (Blueprint $table) {
            $table->id();

            // Polymorphic relation to whatever is being checked into
            // (Event, ClassSession, GymVisit, etc.)
            $table->morphs('tokenable');

            // Optional: who this token was issued to. Nullable because
            // some use cases (e.g. anonymous event check-in) don't need it.
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // We NEVER store the raw token — only its HMAC hash. Even a
            // full database leak can't be used to forge or replay a
            // check-in, because you'd still need the app key to produce
            // a hash that matches.
            $table->string('token_hash', 64)->unique();

            // Arbitrary metadata the developer wants to attach
            // (device fingerprint, gate number, notes, etc.)
            $table->json('meta')->nullable();

            $table->boolean('single_use')->default(true);
            $table->timestamp('expires_at');
            $table->timestamp('used_at')->nullable();

            $table->timestamps();

            $table->index(['expires_at', 'used_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('checkin.table', 'checkin_tokens'));
    }
};
