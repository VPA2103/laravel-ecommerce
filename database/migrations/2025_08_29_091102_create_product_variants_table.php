<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // liên kết product

            $table->string('color')->nullable();
            $table->string('size')->nullable();

            $table->decimal('price', 10, 2); // giữ nguyên như DB
            $table->unsignedInteger('stock')->default(0); // giữ nguyên như DB

            $table->timestamps(); // created_at, updated_at
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
