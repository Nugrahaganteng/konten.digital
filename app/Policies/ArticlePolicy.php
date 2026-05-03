<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /**
     * User hanya bisa update artikel miliknya sendiri, atau admin bisa semua.
     */
    public function update(User $user, Article $article): bool
    {
        return $user->id === $article->user_id || $user->isAdmin();
    }

    /**
     * User hanya bisa hapus artikel miliknya sendiri, atau admin bisa semua.
     */
    public function delete(User $user, Article $article): bool
    {
        return $user->id === $article->user_id || $user->isAdmin();
    }
}