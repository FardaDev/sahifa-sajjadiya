<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('verses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('dua_id')->index();
            $table->unsignedMediumInteger('order')->index();
            $table->text('text');
            $table->text('translation')->nullable();

            $table->timestamps();
            $table->softDeletes()->index();

            $table->index(['created_at']);
            $table->unique(['dua_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verses');
    }
};
