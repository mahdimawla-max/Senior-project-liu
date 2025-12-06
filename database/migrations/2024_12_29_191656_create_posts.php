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
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->text('content');
            $table->text('description')->nullable();
            $table->foreignId('userid')->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade')
            ->references('id')->on('users');    
            $table->foreignId('categoryid')->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade')
            ->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
