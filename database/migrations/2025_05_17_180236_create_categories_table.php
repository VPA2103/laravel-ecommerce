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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Tự động tăng ID
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable(); // đúng kiểu dữ liệu
            $table->timestamps();

            // Nếu muốn ràng buộc khóa ngoại (tùy chọn)
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
