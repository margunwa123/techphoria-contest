<?php

namespace App\Models;

use App\Models\Client\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
  use HasFactory;

  public function company()
  {
    return $this->belongsTo(Company::class);
  }

  public function appliedRequests()
  {
    return $this->hasMany(ApplyRequest::class);
  }
}
