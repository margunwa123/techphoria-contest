<?php

namespace App\Models;

use App\Models\Client\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalRequest extends Model
{
  use HasFactory;

  public function consultant()
  {
    return $this->belongsTo(Consultant::class);
  }

  public function company()
  {
    return $this->belongsTo(Company::class);
  }
}
