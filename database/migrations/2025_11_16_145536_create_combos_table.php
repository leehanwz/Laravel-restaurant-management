<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('combos', function (Blueprint $table) {
            $table->id(); // khóa chính tự động
            $table->string('name'); // tên combo
            $table->decimal('price', 10, 2)->nullable(); // giá combo, nullable vì lúc tạo combo chưa có món
            $table->text('description')->nullable(); // mô tả combo, có thể update sau
            $table->json('gift_items')->nullable(); // đồ tặng kèm, JSON
            $table->string('image')->nullable(); // ảnh combo
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('combos');
    }
};
