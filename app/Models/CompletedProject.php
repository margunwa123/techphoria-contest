<?php

namespace App\Models;

use App\Models\Client\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedProject extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function company()
  {
    return $this->belongsTo(Company::class);
  }

  public function consultant()
  {
    return $this->belongsTo(Consultant::class);
  }
}
