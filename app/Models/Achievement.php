<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Traits\CodeGenerate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid as Generator;

class Achievement extends Model
{
  use HasFactory, Uuid, CodeGenerate;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'code',
    'name',
    'point',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Generate auto code.
   */
  protected static function boot()
  {
    parent::boot();

    static::creating(function ($achievement) {
      $achievement->code = self::generateCode('JP');
    });

    static::creating(function ($achievement) {
      $achievement->uuid = Generator::uuid4()->toString();
    });
  }
}
