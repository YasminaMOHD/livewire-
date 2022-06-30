<?php

namespace App\Policies;

use App\Models\Manger;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MangerPolicy
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
        $user->hasAbility('view-manger',Manger::class);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manger  $manger
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Manger $manger)
    {
        $user->hasAbility('view-manger',$manger);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $user->hasAbility('create-manger',Manger::class);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manger  $manger
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Manger $manger)
    {
        $user->hasAbility('update-manger',$manger);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manger  $manger
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Manger $manger)
    {
        $user->hasAbility('delete-manger',$manger);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manger  $manger
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Manger $manger)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manger  $manger
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Manger $manger)
    {
        //
    }
}
