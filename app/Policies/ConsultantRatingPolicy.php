<?php

namespace App\Policies;

use App\Models\Consultant\ConsultantRating;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConsultantRatingPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\ConsultantRating  $consultantRating
   * @return mixed
   */
  public function update(User $user, ConsultantRating $consultantRating)
  {
    return $user->id == $consultantRating->completedProject->company->user_id;
  }
}
