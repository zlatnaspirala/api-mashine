<?php

namespace App\Policies;

use App\User;
use App\Gameplay;
use Illuminate\Auth\Access\HandlesAuthorization;

class GameplayPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Gameplay  $post
     * @return mixed
     */
    public function view(User $user, Gameplay $post)
    {
        return true;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Gameplay  $post
     * @return mixed
     */
    public function update(User $user, Gameplay $post)
    {
        return $user->is($post->author);
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Gameplay  $post
     * @return mixed
     */
    public function delete(User $user, Gameplay $post)
    {
        return $this->update($user, $post);
    }
}
