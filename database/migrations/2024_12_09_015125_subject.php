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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('teacher_id'); 
            $table->string('name', 255);
            $table->unsignedInteger('detail_id');
            $table->timestamps(); 

            // 外部キーの設定
            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('detail_id')
                ->references('id')
                ->on('subject_detail')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
