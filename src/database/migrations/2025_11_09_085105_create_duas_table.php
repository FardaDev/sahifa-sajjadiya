<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('duas', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedSmallInteger('number')->unique();
            $table->string('title', 120)->index();
            $table->string('description', 300)->index()->nullable();

            $table->timestamps();
            $table->softDeletes()->index();

            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duas');
    }
};
