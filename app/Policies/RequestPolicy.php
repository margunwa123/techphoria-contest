<?php

namespace App\Policies;

use App\Models\Client\Company;
use App\Models\Request;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return mixed
   */
  public function create(User $user, Company $company)
  {
    return $user->id == $company->user_id;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Request  $request
   * @return mixed
   */
  public function update(User $user, Request $request)
  {
    return ($request->company->user_id == $user->id) && (count($request->appliedRequests) == 0);
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Request  $request
   * @return mixed
   */
  public function delete(User $user, Request $request)
  {
    return $user->id == $request->company->user_id;
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Request  $request
   * @return mixed
   */
  public function restore(User $user, Request $request)
  {
    //
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Request  $request
   * @return mixed
   */
  public function forceDelete(User $user, Request $request)
  {
    //
  }
}
