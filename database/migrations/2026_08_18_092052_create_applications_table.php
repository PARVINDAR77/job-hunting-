<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_id');

            $table->string('resume')->nullable();
            $table->text('cover_letter')->nullable();
            $table->string('experience')->nullable();
            $table->string('education')->nullable();
            $table->string('status')->default('pending');

            $table->timestamps();

            // Index for performance
            $table->index('user_id');
            $table->index('job_id');
        });

        // Add foreign keys after all tables exist
        Schema::table('applications', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};