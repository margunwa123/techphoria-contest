<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function personalRequests()
  {
    return $this->hasMany(PersonalRequest::class);
  }

  public function applyRequests()
  {
    return $this->hasMany(ApplyRequest::class);
  }

  public function projects()
  {
    return $this->hasMany(Project::class);
  }

  public function completedProjects()
  {
    return $this->hasMany(CompletedProject::class);
  }
}
