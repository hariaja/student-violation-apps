<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
  use HasFactory, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'room_id',
    'name',
    'father',
    'mother',
    'email',
    'phone',
    'gender',
    'place_of_birth',
    'date_of_birth',
    'address',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'date_of_birth' => 'date:c',
  ];

  /**
   * Declar gender label.
   *
   * @return Attribute
   */
  public function genderLabel(): Attribute
  {
    $genderLabel = [
      'male' => "Laki - Laki",
      'female' => "Perempuan",
    ];

    return Attribute::make(
      get: fn () => $genderLabel[$this->gender] ?? 'Tidak Diketahui',
    );
  }

  /**
   * Relation to room model.
   *
   * @return BelongsTo
   */
  public function room(): BelongsTo
  {
    return $this->belongsTo(Room::class, 'room_id');
  }
}
