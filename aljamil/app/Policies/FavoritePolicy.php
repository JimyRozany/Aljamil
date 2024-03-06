<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Favorite;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Favorite $favorite)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Favorite $favorite)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Favorite $favorite)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Favorite $favorite)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Favorite $favorite)
    {
        //
    }
}
