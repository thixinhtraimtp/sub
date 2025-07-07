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
        Schema::create('partner_websites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->string('url');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('inactive');
            $table->string('zone_id')->nullable();
            $table->string('zone_name')->nullable();
            $table->string('zone_status')->nullable();
            $table->longText('zone_data')->nullable();
            $table->timestamps();
            $table->string('domain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_websites');
    }
};
