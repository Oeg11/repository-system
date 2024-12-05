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
        Schema::create('usercontrols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->nullable();
            $table->tinyInteger('collectionlist_view')->default('0');
            $table->tinyInteger('collectionlist_updatestatus')->default('0');
            $table->tinyInteger('collectionlist_delete')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usercontrols');
    }
};
