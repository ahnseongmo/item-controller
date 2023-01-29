<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            // 카테고리 아이디를 외래키로 받는다.
            $table->foreignId('category_id');
            $table->text('description');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('count');
            $table->text('image')->nullable();
            $table->boolean('useyn')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
