<?php

namespace App\Policies;

use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class ManufacturerPolicy
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
        return $user->can('manufacturer.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Manufacturer $manufacturer)
    {
        return $user->can('manufacturer.index');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('manufacturer.store');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Manufacturer $manufacturer)
    {
        return $user->can('manufacturer.store') && $user->id === $manufacturer->created_by;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Manufacturer $manufacturer)
    {
        return $user->can('manufacturer.store') && $user->id === $manufacturer->created_by && $manufacturer->deleted_at === null;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Manufacturer $manufacturer)
    {
        return $user->can('manufacturer.store') && $user->id === $manufacturer->created_by && $manufacturer->deleted_at !== null;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Manufacturer $manufacturer)
    {
        return false;
    }
}
