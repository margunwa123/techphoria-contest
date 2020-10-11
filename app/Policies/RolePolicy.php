<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class RolePolicy
{
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  public function isClient()
  {
    return Auth::user()->role == "client";
  }

  public function isConsultant()
  {
    return Auth::user()->role == "consultant";
  }
}
