<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdministratorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Administrator  $user
     * @param  \App\Administrator  $model
     * @return mixed
     */
    public function view(Administrator $user, Administrator $model)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Administrator  $user
     * @return mixed
     */
    public function create(Administrator $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(Administrator $user, Administrator $model)
    {
        return $user->is($model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(Administrator $user, Administrator $model)
    {
        return $this->update($user, $model);
    }
}
