<?php

namespace App\Helpers\Fuzzy;

class Violation
{
  public static function ringanSekali($violation)
  {
    if ($violation <= 3) {
      return 1;
    } elseif ($violation >= 3 and $violation <= 50) {
      return (50 - $violation) / (50 - 3);
    } else {
      return 0;
    }
  }

  public static function ringan($violation)
  {
    if ($violation <= 3 || $violation >= 109) {
      return 0;
    } elseif ($violation >= 3 and $violation <= 50) {
      return ($violation - 3) / (50 - 3);
    } elseif ($violation >= 50 and $violation <= 109) {
      return (109 - $violation) / (109 - 50);
    }
  }

  public static function sedang($violation)
  {
    if ($violation <= 50 || $violation >= 149) {
      return 0;
    } elseif ($violation >= 50 and $violation <= 109) {
      return ($violation - 50) / (109 - 50);
    } elseif ($violation >= 109 and $violation <= 149) {
      return (149 - $violation) / (149 - 109);
    }
  }

  public static function berat($violation)
  {
    if ($violation <= 109 || $violation >= 169) {
      return 0;
    } elseif ($violation >= 109 and $violation <= 149) {
      return ($violation - 109) / (149 - 109);
    } elseif ($violation >= 149 and $violation <= 169) {
      return (169 - $violation) / (169 - 149);
    }
  }

  public static function beratSekali($violation)
  {
    if ($violation <= 149 || $violation >= 189) {
      return 0;
    } elseif ($violation >= 149 and $violation <= 169) {
      return ($violation - 149) / (169 - 149);
    } elseif ($violation >= 169 and $violation <= 189) {
      return (189 - $violation) / (189 - 169);
    }
  }

  public static function sangatBeratSekali($violation)
  {
    if ($violation <= 169 || $violation >= 200) {
      return 0;
    } elseif ($violation >= 169 and $violation <= 189) {
      return ($violation - 169) / (189 - 169);
    } elseif ($violation >= 189 and $violation <= 200) {
      return (200 - $violation) / (200 - 189);
    }
  }
}
