<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Work;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
          $user->hasAbility('view-work',Work::class);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Work $work)
    {
          $user->hasAbility('view-work',$work);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
          $user->hasAbility('create-work',Work::class);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Work $work)
    {
          $user->hasAbility('update-work',$work);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Work $work)
    {
        $user->hasAbility('delete-request',$work);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Work $work)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Work $work)
    {
        //
    }
}
