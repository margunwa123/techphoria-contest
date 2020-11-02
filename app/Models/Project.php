<?php

namespace App\Models;

use App\Models\Client\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Project extends Model
{
  use HasFactory;
  protected $guarded = [];

  public static function boot()
  {
    parent::boot();

    static::created(function ($project) {
      $notificationClient = new Notification([
        'title' => "New project",
        'body' => 'Project with company ' . $project->company->name . ' has been created, go check out your project tab',
        'read' => False,
        'user_id' => $project->company->user_id
      ]);
      $notificationConsultant = new Notification([
        'title' => "New project",
        'body' => 'Project with company ' . $project->company->name . ' has been created, go check out your project tab',
        'read' => False,
        'user_id' => $project->consultant->user_id
      ]);
      $notificationClient->save();
      $notificationConsultant->save();
    });
  }

  public static function MakeProject($data)
  {
    $data = Project::validate($data)->validate();
    $project = new Project($data);
    $project->save();
    return $project;
  }

  public static function validate($data)
  {
    return Validator::make($data, [
      'company_id' => ['required', 'integer', 'min:0'],
      'consultant_id' => ['required', 'integer', 'min:0'],
      'finance_type' => ['required'],
      'fee' => ['required'],
      'description' => ['required']
    ]);
  }

  public function company()
  {
    return $this->belongsTo(Company::class);
  }

  public function consultant()
  {
    return $this->belongsTo(Consultant::class);
  }
}
