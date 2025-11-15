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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_category_id'); // liên kết danh mục
            $table->json('name');                           // tên món dạng JSON (dùng cho combo hoặc đa ngôn ngữ)
            $table->text('description')->nullable();        // mô tả món
            $table->decimal('price', 10, 2);                // giá món
            $table->json('images')->nullable();             // nhiều ảnh
            $table->string('size')->nullable();             // size / gram
            $table->integer('order')->default(0);           // thứ tự hiển thị
            $table->boolean('is_available')->default(true); // trạng thái món
            $table->timestamps();

            // Khóa ngoại liên kết MenuCategory
            $table->foreign('menu_category_id')
                ->references('id')
                ->on('menu_categories')
                ->onDelete('restrict'); // không xóa danh mục nếu còn sản phẩm
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
