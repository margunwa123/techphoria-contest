<?php

namespace App\Models\Consultant;

use App\Models\CompletedProject;
use App\Models\Consultant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultantRating extends Model
{
  use HasFactory;

  protected $guarded = [];

  public static function boot()
  {
    parent::boot();

    // Misal dibuat otomatis ganti rating konsultan disini
    static::created(function (ConsultantRating $consultantRating) {
      $consultantRatings = ConsultantRating::where('consultant_id', $consultantRating->consultant_id)->get();
      $sumRating = 0;
      foreach ($consultantRatings as $rating) {
        $sumRating += $rating->rating;
      }
      $avgRating = $sumRating / count($consultantRatings);
      $consultantRating->consultant()->update([
        'rating' => $avgRating,
      ]);
    });
  }

  public function consultant()
  {
    return $this->belongsTo(Consultant::class);
  }

  public function completedProject()
  {
    return $this->belongsTo(CompletedProject::class);
  }
}
