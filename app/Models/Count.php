<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Count extends Model
{
  use HasFactory, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'student_id',
    'achievement_id',
    'violation_id',
    'score',
    'qualification',
    'description',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Relation to student model.
   *
   * @return BelongsTo
   */
  public function student(): BelongsTo
  {
    return $this->belongsTo(Student::class, 'student_id');
  }

  /**
   * Relation to achievement model.
   *
   * @return void
   */
  public function achievement()
  {
    return $this->belongsTo(Achievement::class, 'achievement_id');
  }

  /**
   * Relation to violation model.
   *
   * @return void
   */
  public function violation()
  {
    return $this->belongsTo(Violation::class, 'violation_id');
  }
}
