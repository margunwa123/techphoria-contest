<?php

namespace App\Models;

use App\Models\Client\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalRequest extends Model
{
  use HasFactory;
  protected $guarded = [];

  public static function boot()
  {
    parent::boot();

    static::created(function ($request) {
      $notificationClient = new Notification([
        'title' => "New personal request",
        'body' => 'There is a personal request from ' . $request->company->name . ' company. Go check out your personal request tab',
        'read' => False,
        'user_id' => $request->consultant->user->id
      ]);
      $notificationClient->save();
    });
  }

  public function consultant()
  {
    return $this->belongsTo(Consultant::class);
  }

  public function company()
  {
    return $this->belongsTo(Company::class);
  }
}
