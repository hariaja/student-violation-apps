<?php

namespace App\Helpers\Fuzzy;

class Achievement
{
  public static function kecil($achievement)
  {
    if ($achievement <= 2) {
      return 1;
    } elseif ($achievement >= 12.5) {
      return 0;
    } elseif ($achievement > 2 and $achievement < 12.5) {
      return (12.5 - $achievement) / (12.5 - 2);
    }
  }

  public static function sedang($achievement)
  {
    if ($achievement <= 2 || $achievement >= 25) {
      return 0;
    } elseif ($achievement >= 12.5 and $achievement <= 25) {
      return (25 - $achievement) / (25 - 12.5);
    } elseif ($achievement > 2 and $achievement < 12.5) {
      return ($achievement - 2) / (12.5 - 2);
    }
  }

  public static function besar($achievement)
  {
    if ($achievement <= 12.5) {
      return 0;
    } elseif ($achievement >= 25) {
      return 1;
    } elseif ($achievement > 12.5 and $achievement < 25) {
      return ($achievement - 12.5) / (25 - 12.5);
    }
  }
}
