<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    public function modify(User $user, Product $product)
    {
        return $user->id === $product->user_id;
    }
}
