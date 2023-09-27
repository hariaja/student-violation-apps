<?php

use App\Helpers\Enums\GenderType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('students', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->string('name');
      $table->string('father');
      $table->string('mother');
      $table->string('email')->unique();
      $table->string('phone')->unique();
      $table->enum('gender', GenderType::toArray());
      $table->string('place_of_birth');
      $table->date('date_of_birth');
      $table->longText('address');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('students');
  }
};
