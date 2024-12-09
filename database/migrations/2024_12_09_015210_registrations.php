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
        //
        Schema::create('registrations',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedInteger('course_id')->index();
            $table->unsignedTinyInteger('attempts');
            $table->timestamp('registered_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp();

            $table->foreign('user_id')
            ->reference('id')
            ->on('users')
            ->onUpdate('cascade');

            $table->foreign('subject_id')
            ->reference('id')
            ->on('subjects')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('registrations');
    }
};
