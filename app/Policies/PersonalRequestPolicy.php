<?php

namespace App\Policies;

use App\Models\PersonalRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonalRequestPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return mixed
   */
  public function viewAny(User $user)
  {
    // No user can view all of the personal request
    return False;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\PersonalRequest  $personalRequest
   * @return mixed
   */
  public function view(User $user, PersonalRequest $personalRequest)
  {
    // either the user is the creator of the request, or the user is the consultant
    return ($user->id == $personalRequest->client_id || $user->id == $personalRequest->consultant_id);
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    return $user->role == "client";
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\PersonalRequest  $personalRequest
   * @return mixed
   */
  public function update(User $user, PersonalRequest $personalRequest)
  {
    return $user->id == $personalRequest->company->user_id;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\PersonalRequest  $personalRequest
   * @return mixed
   */
  public function delete(User $user, PersonalRequest $personalRequest)
  {
    return $user->id == $personalRequest->client_id;
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\PersonalRequest  $personalRequest
   * @return mixed
   */
  public function forceDelete(User $user, PersonalRequest $personalRequest)
  {
    return $user->id == $personalRequest->client_id;
  }
}
