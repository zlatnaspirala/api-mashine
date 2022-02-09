<?php

namespace App\Policies;

use App\User;
use App\Avatar;
use Illuminate\Auth\Access\HandlesAuthorization;

class AvatarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Avatar  $post
     * @return mixed
     */
    public function view(User $user, Avatar $post)
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
     * @param  \App\Avatar  $post
     * @return mixed
     */
    public function update(User $user, Avatar $post)
    {
        return $user->is($post->author);
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Avatar  $post
     * @return mixed
     */
    public function delete(User $user, Avatar $post)
    {
        return $this->update($user, $post);
    }
}
