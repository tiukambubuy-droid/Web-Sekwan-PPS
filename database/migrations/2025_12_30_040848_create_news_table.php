<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            // Konten utama
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();       // ringkasan
            $table->longText('content');               // isi berita

            // Media & meta
            $table->string('thumbnail')->nullable();   // path gambar
            $table->string('author')->nullable();      // nama penulis

            // Status & waktu
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
