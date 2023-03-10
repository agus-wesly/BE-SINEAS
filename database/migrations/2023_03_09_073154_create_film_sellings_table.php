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
        Schema::create('film_sellings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->foreignId('film_id')->constrained('films');
            $table->foreignUuid('film_selling_price_id')->constrained('film_selling_prices');
            $table->date('expired_date');
            $table->enum('status', ['active', 'comingsoon', 'expired']);
            $table->boolean('is_free')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_sellings');
    }
};
