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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('archive_code')->nullable();
            $table->foreignId('curriculum_id')->nullable();
            $table->string('year')->nullable();
            $table->string('title')->nullable();
            $table->string('abstract')->nullable();
            $table->string('members')->nullable();
            $table->string('banner_path')->nullable();
            $table->string('document_path')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('student_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
