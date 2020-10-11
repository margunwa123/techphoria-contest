<?php

namespace App\Policies;

use App\Models\Client\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    return $user->role == 'client';
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Company  $company
   * @return mixed
   */
  public function update(User $user, Company $company)
  {
    return $user->id == $company->user_id;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Company  $company
   * @return mixed
   */
  public function delete(User $user, Company $company)
  {
    return $user->id == $company->user_id;
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Company  $company
   * @return mixed
   */
  public function forceDelete(User $user, Company $company)
  {
    return $user->id == $company->user_id;
  }
}
