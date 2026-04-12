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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path'); // Път до файла в storage
            $table->string('original_filename')->nullable(); // Ориг. име на файла (полезно)
            $table->string('mime_type')->nullable(); // MIME тип
            $table->unsignedBigInteger('size')->nullable(); // Размер в байтове
            $table->foreignId('uploaded_by_user_id')->constrained('users')->onDelete('cascade'); // Връзка към потребител (учител/админ)
            $table->boolean('is_published')->default(false); // Флаг за публикуване
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
