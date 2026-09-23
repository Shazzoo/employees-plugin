<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_studio_employees', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('image_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('name');
            $table->string('role');
            $table->json('skills');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_studio_employees');
    }
};
