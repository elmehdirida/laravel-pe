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

        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("amount");
            $table->string("payment_method", 100);
            $table->string("payment_status", 100);
            $table->foreignId("order_id")->constrained("order")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
