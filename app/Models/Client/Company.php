<?php

namespace App\Models\Client;

use App\Models\CompletedProject;
use App\Models\PersonalRequest;
use App\Models\Project;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function personalRequests()
  {
    return $this->hasMany(PersonalRequest::class);
  }

  public function requests()
  {
    return $this->hasMany(Request::class);
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
