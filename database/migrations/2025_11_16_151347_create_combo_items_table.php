<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('combo_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('combo_id')
                ->constrained('combos') // liên kết với combos.id
                ->onDelete('cascade');  // xóa combo → xóa luôn các món trong combo

            $table->foreignId('product_id')
                ->constrained('products') // liên kết với products.id
                ->onDelete('cascade');    // xóa món → xóa luôn khỏi combo

            $table->integer('quantity')->default(1); // số lượng món trong combo

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('combo_items');
    }
};
