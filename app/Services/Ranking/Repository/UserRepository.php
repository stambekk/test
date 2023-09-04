<?php

namespace App\Services\Ranking\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{

    public function find(int $userId)
    {
        return User::query()->findOrFail($userId);
    }

    public function updateScore(int $userId, int $score): \Illuminate\Database\Eloquent\Builder|array|Collection|\Illuminate\Database\Eloquent\Model
    {
        $user = User::query()->find($userId);

        $user->score = $score;
        $user->save();
        return $user;
    }

    public function getTopUsers($limit): Collection|array
    {
        return User::query()
            ->orderByDesc('score')
            ->limit($limit)
            ->get();
    }
}