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



  public static function MakeProject($data)
  {
    $data = Project::validate($data)->validate();
    $project = new Project($data);
    $project->save();
    return $project;
  }

  public static function Validate($data)
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
