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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 10, 2);
            $table->string('card_number'); // Enregistré sous forme chiffrée
            $table->date('expiration_date');
            $table->string('cvv')->nullable(); // Si besoin, mais chiffrez-le également
            $table->string('transaction_id'); // Numéro unique de transaction
            $table->boolean('refunded')->default(false);
            $table->timestamp('refunded_at')->nullable();
            $table->decimal('refunded_amount', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
