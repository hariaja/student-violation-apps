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
    Schema::create('counts', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('student_id')->constrained()->onDelete('cascade');
      $table->foreignId('achievement_id')->constrained()->onDelete('cascade');
      $table->foreignId('violation_id')->constrained()->onDelete('cascade');
      $table->float('score');
      $table->string('qualification');
      $table->longText('description');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('counts');
  }
};
