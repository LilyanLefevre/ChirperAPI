<?php

use App\Models\Chirp;
use App\Models\User;
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
        Schema::create('chirp_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chirp_id')->references('id')->on("chirps")->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on("users")->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chirp_likes');
    }
};
