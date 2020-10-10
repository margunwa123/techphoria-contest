<?php

namespace App\Models;

use App\Models\Client\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  public static function boot()
  {
    parent::boot();

    static::created(function ($user) {
      if ($user->role == "consultant") {
        $user->consultant()->create([
          'rating' => 0,
          'finance_type' => 'perpajakan'
        ]);
      }
    });
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $guarded = [
    'password_confirmation'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function isClient()
  {
    return $this->role == "client";
  }

  public function isConsultant()
  {
    return $this->role == "consultant";
  }

  public function companies()
  {
    return $this->hasMany(Company::class);
  }

  public function consultant()
  {
    return $this->hasOne(Consultant::class);
  }
}
