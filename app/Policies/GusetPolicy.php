<?php

namespace App\Policies;

use App\Models\Guset;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GusetPolicy
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
         $user->hasAbility('view-user',$user);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guset  $guset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Guset $guset)
    {
         $user->hasAbility('view-user',$user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $user->hasAbility('create-user',$user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guset  $guset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Guset $guset)
    {
        $user->hasAbility('update-user',$user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guset  $guset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Guset $guset)
    {
        $user->hasAbility('delete-user',$user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guset  $guset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Guset $guset)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guset  $guset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Guset $guset)
    {
        //
    }
}
