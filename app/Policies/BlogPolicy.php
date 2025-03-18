<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPolicy
{
    public function modify(User $user, Blog $blog)
    {
        return $user->id === $blog->user_id || $user->role === 'admin';
    }
}
