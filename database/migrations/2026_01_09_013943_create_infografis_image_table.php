<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('infografis_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('infografis_id')
                ->constrained('infografis')
                ->onDelete('cascade');

            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->integer('urutan')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('infografis_images');
    }
};
