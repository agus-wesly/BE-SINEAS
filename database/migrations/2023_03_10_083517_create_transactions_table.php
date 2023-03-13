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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->string('payment_status');
            $table->string('payment_method');
            $table->date('payment_date');
            $table->date('watch_expired_date');
            $table->string('title_film');
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignId('film_id')->constrained('films');
            $table->foreignUuid('film_selling_id')->constrained('film_sellings');
            $table->integer('total');
            $table->integer('tax');
            $table->integer('subtotal');
            $table->date('transaction_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
