<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->string('payment_status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->date('payment_date')->default(now());
            $table->date('watch_expired_date')->nullable();
            $table->string('title_film');
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignId('film_id')->constrained('films');
            $table->foreignUuid('film_selling_id')->constrained('film_sellings');
            $table->integer('total');
            $table->integer('tax');
            $table->integer('subtotal');
            $table->date('transaction_date')->default(now());
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
