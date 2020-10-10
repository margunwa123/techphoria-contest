<?php

namespace App\Models;

use App\Models\Client\Company;
use App\Models\Consultant\ConsultantRating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedProject extends Model
{
  use HasFactory;
  protected $guarded = [];

  public static function boot()
  {
    parent::boot();

    static::created(function (CompletedProject $completedProject) {
      $completedProject->consultantRating()->create([
        'completed_project_id' => $completedProject->id,
        'rating' => 5,
        'review' => 'reccomended',
        'consultant_id' => $completedProject->consultant_id
      ]);
    });
  }

  public function company()
  {
    return $this->belongsTo(Company::class);
  }

  public function consultant()
  {
    return $this->belongsTo(Consultant::class);
  }

  public function consultantRating()
  {
    return $this->hasOne(ConsultantRating::class);
  }
}
