<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Project  $project
   * @return mixed
   */
  public function view(User $user, Project $project)
  {
    return ($user->id == $project->client_id || $user->id == $project->consultant_id);
  }
  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Project  $project
   * @return mixed
   */
  public function delete(User $user, Project $project)
  {
    return ($user->id == $project->client_id || $user->id == $project->consultant_id);
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Project  $project
   * @return mixed
   */
  public function forceDelete(User $user, Project $project)
  {
    return ($user->id == $project->client_id || $user->id == $project->consultant_id);
  }
}
