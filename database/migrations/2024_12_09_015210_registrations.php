<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->unsignedBigInteger('user_id')->index(); // 外部キー用
            $table->unsignedBigInteger('subject_id')->index(); // 外部キー用
            $table->unsignedTinyInteger('attempts'); // 試行回数
            $table->timestamp('registered_at')->default(DB::raw('CURRENT_TIMESTAMP')); // 登録日時
            $table->timestamps(); // created_at と updated_at

            // 外部キー制約
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // 必要に応じて追加

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
