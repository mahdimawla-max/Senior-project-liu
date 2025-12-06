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
        Schema::create('users_shares', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->foreignId('userid')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('shareid')
            ->references('id')->on('shares')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usersshares');
    }
};
