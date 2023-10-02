<?php

namespace App\Services\Count;

use App\Helpers\Fuzzy\Achievement;
use App\Helpers\Fuzzy\Violation;
use App\Repositories\Achievement\AchievementRepository;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\Count\CountRepository;
use App\Repositories\Violation\ViolationRepository;

class CountServiceImplement extends Service implements CountService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  public function __construct(
    protected CountRepository $mainRepository,
    protected AchievementRepository $achievementRepository,
    protected ViolationRepository $violationRepository,
  ) {
    // 
  }

  public function getQuery()
  {
    try {
      DB::beginTransaction();
      return $this->mainRepository->getQuery();
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }

  public function handleCreateData($request)
  {
    try {
      DB::beginTransaction();

      $payload = $request->validated();

      // Temukan Data Prestasi & Pelanggaran
      $achievement = $this->achievementRepository->findOrFail($payload['achievement_id']);
      $violation = $this->violationRepository->findOrFail($payload['violation_id']);

      // Tentukan Point nya
      $achievementPoint = (int) $achievement->point;
      $violationPoint = (int) $violation->point;

      // Mari kita hitung step by step
      // Mencari nilai drajat untuk prestasi
      $achievementKecil = Achievement::kecil(12);
      $achievementSedang = Achievement::sedang(12);
      $achievementBesar = Achievement::besar(12);

      // Mencari nilai drajat untuk pelanggaran
      $violationRinganSekali = Violation::ringanSekali(90);
      $violationRingan = Violation::ringan(90);
      $violationSedang = Violation::sedang(90);
      $violationBerat = Violation::berat(90);
      $violationBeratSekali = Violation::beratSekali(90);
      $violationSangatBeratSekali = Violation::sangatBeratSekali(90);



      // Mencari Nilai z dengan rumus aturan.
      $rule1 = min($violationRinganSekali, $achievementKecil);
      $z1 = 50 - $rule1 * (50 - 3); // Ringan Sekali

      // Mencari nilai Z itu rumusnya:
      // Nilai Z Max - Nilai Alpha * (Z Max - Z min)

      $rule2 = min($violationRinganSekali, $achievementSedang);
      $z2 = 50 - $rule2 * (50 - 3); // Ringan Sekali

      $rule3 = min($violationRinganSekali, $achievementBesar);
      $z3 = 50 - $rule3 * (50 - 3); // Ringan Sekali

      $rule4 = min($violationRingan, $achievementKecil);
      $z4 = 109 - $rule4 * (109 - 50); // Ringan

      $rule5 = min($violationRingan, $achievementSedang);
      $z5 = 109 - $rule5 * (109 - 50); // Ringan

      $rule6 = min($violationRingan, $achievementBesar);
      $z6 = 109 - $rule6 * (109 - 50); // Ringan

      $rule7 = min($violationSedang, $achievementKecil);
      $z7 = 149 - $rule7 * (149 - 109); // Sedang

      $rule8 = min($violationSedang, $achievementSedang);
      $z8 = 149 - $rule8 * (149 - 109); // Sedang

      $rule9 = min($violationSedang, $achievementBesar);
      $z9 = 149 - $rule9 * (149 - 109); // Sedang

      $rule10 = min($violationBerat, $achievementKecil);
      $z10 = 169 - $rule10 * (169 - 149); // Berat

      $rule11 = min($violationBerat, $achievementSedang);
      $z11 = 169 - $rule11 * (169 - 149); // Berat

      $rule12 = min($violationBerat, $achievementBesar);
      $z12 = 169 - $rule12 * (169 - 149); // Berat

      $rule13 = min($violationBeratSekali, $achievementKecil);
      $z13 = 189 - $rule13 * (189 - 169); // Berat Sekali

      $rule14 = min($violationBeratSekali, $achievementSedang);
      $z14 = 189 - $rule14 * (189 - 169); // Berat Sekali

      $rule15 = min($violationBeratSekali, $achievementBesar);
      $z15 = 189 - $rule15 * (189 - 169); // Berat Sekali

      $rule16 = min($violationSangatBeratSekali, $achievementKecil);
      $z16 = 200 - $rule16 * (200 - 189); // Sangat Berat Sekali

      $rule17 = min($violationSangatBeratSekali, $achievementSedang);
      $z17 = 200 - $rule17 * (200 - 189); // Sangat Berat Sekali

      $rule18 = min($violationSangatBeratSekali, $achievementBesar);
      $z18 = 200 - $rule18 * (200 - 189); // Sangat Berat Sekali

      $totalRule = ($rule1 * $z1) + ($rule2 * $z2) + ($rule3 * $z3) + ($rule4 * $z4) + ($rule5 * $z5) + ($rule6 * $z6) + ($rule7 * $z7) + ($rule8 * $z8) + ($rule9 * $z9) + ($rule10 * $z10) + ($rule11 * $z11) + ($rule12 * $z12) + ($rule13 * $z13) + ($rule14 * $z14) + ($rule15 * $z15) + ($rule16 * $z16) + ($rule17 * $z17) + ($rule18 * $z18);

      $totalNilaiZ = $rule1 + $rule2 + $rule3 + $rule4 + $rule5 + $rule6 + $rule7 + $rule8 + $rule9 + $rule10 + $rule11 + $rule12 + $rule13 + $rule14 + $rule15 + $rule16 + $rule17 + $rule18;

      $defuzzyfikasi = $totalRule / $totalNilaiZ;

      if ($defuzzyfikasi >= 3 and $defuzzyfikasi <= 50) {
        $qualification = 'Teguran I';
        $description = "Peringatan Lisan";
      } else if ($defuzzyfikasi > 50 and $defuzzyfikasi <= 109) {
        $qualification = 'Teguran II';
        $description = "Peringatan tertulis, tebusan ke orang tua";
      } else if ($defuzzyfikasi > 109 and $defuzzyfikasi <= 149) {
        $qualification = 'Teguran III';
        $description = "Pernyataan tertulis, penugasan, orang tua hadir ke sekolah, pembinaan BK";
      } else if ($defuzzyfikasi > 149 and $defuzzyfikasi <= 169) {
        $qualification = 'Sanksi I';
        $description = "Skorsing selama 2 hari, siswa tidak hadir di sekolah, pembinaan dari BK";
      } else if ($defuzzyfikasi > 169 and $defuzzyfikasi <= 189) {
        $qualification = 'Sanksi II';
        $description = "Skorsing selama 3 hari, siswa tidak hadir di sekolah, pembinaan dari BK";
      } else if ($defuzzyfikasi > 189) {
        $qualification = "Sanksi III";
        $description = "Disarankan untuk mengundurkan diri";
      }

      // Create data to counts table
      $payload['score'] = $defuzzyfikasi;
      $payload['qualification'] = $qualification;
      $payload['description'] = $description;

      // dd([
      //   'pelanggaran ringanSekali' => $violationRinganSekali,
      //   'pelanggaran ringan' => $violationRingan,
      //   'pelanggaran sedang' => $violationSedang,
      //   'pelanggaran berat' => $violationBerat,
      //   'pelanggaran beratSekali' => $violationBeratSekali,
      //   'pelanggaran sangatBeratSekali' => $violationSangatBeratSekali,

      //   'total pelanggaran' => $violationRinganSekali + $violationRingan + $violationSedang + $violationBerat + $violationBeratSekali + $violationSangatBeratSekali,

      //   "------------------------------------------------" => "------------------------------------------------",

      //   'prestasi ringan' => $achievementKecil,
      //   'prestasi sedang' => $achievementSedang,
      //   'prestasi berat' => $achievementBesar,

      //   'total prestasi' => $achievementKecil + $achievementSedang + $achievementBesar,

      //   "--------------------------------------------" => "------------------------------------------------",

      //   'rule 1' => $rule1,
      //   'rule 2' => $rule2,
      //   'rule 3' => $rule3,

      //   'rule 4' => $rule4,
      //   'rule 5' => $rule5,
      //   'rule 6' => $rule6,

      //   'rule 7' => $rule7,
      //   'rule 8' => $rule8,
      //   'rule 9' => $rule9,

      //   'rule 10' => $rule10,
      //   'rule 11' => $rule11,
      //   'rule 12' => $rule12,

      //   'rule 13' => $rule13,
      //   'rule 14' => $rule14,
      //   'rule 15' => $rule15,

      //   'rule 16' => $rule16,
      //   'rule 17' => $rule17,
      //   'rule 18' => $rule18,

      //   "----------------------------------------------" => "------------------------------------------------",
      //   "---------------------------------------------" => "------------------------------------------------",

      //   'z 1' => $z1,
      //   'z 2' => $z2,
      //   'z 3' => $z3,

      //   'z 4' => $z4,
      //   'z 5' => $z5,
      //   'z 6' => $z6,

      //   'z 7' => $z7,
      //   'z 8' => $z8,
      //   'z 9' => $z9,

      //   'z 10' => $z10,
      //   'z 11' => $z11,
      //   'z 12' => $z12,

      //   'z 13' => $z13,
      //   'z 14' => $z14,
      //   'z 15' => $z15,

      //   'z 16' => $z16,
      //   'z 17' => $z17,
      //   'z 18' => $z18,

      //   "------------------------------------------" => "------------------------------------------------",
      //   "------------------------------------------" => "------------------------------------------------",

      //   'totalRule' => $totalRule,
      //   'totalNilaiZ' => $totalNilaiZ,

      //   'deufuzzyfikasi' => $defuzzyfikasi,
      //   'qualification' => $qualification,
      //   'description' => $description,
      // ]);

      $this->mainRepository->create($payload);

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }

  public function getStudentCount($start, $end)
  {
    try {
      DB::beginTransaction();
      return $this->mainRepository->getStudentCount($start, $end);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }

  public function getLastThreeMonth()
  {
    try {
      DB::beginTransaction();
      return $this->mainRepository->getLastThreeMonth();
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }
}
