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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name", 100);
            $table->text("description");
            $table->decimal("price", 8, 2);
            $table->integer("stock");
            $table->integer("rating")->nullable()->default(0)->max(5);
            $table->foreignId("category_id")->constrained("category")->cascadeOnDelete();
            $table->foreignId("discount_id")->constrained("discount")->cascadeOnDelete();
            $table->string("image", 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
