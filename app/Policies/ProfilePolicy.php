<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $profile
   * @return mixed
   */
  public function update(User $authuser, User $user)
  {
    return $authuser->id == $user->id;
  }
}
