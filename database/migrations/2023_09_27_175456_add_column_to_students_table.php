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
    Schema::table('students', function (Blueprint $table) {
      $table->foreignId('room_id')->after('uuid')->constrained()->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('students', function (Blueprint $table) {
      $table->dropForeign('students_room_id_foreign');
      $table->dropColumn('room_id');
    });
  }
};
