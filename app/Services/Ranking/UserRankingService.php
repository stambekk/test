<?php

namespace App\Services\Ranking;

use App\Services\Ranking\Interface\UserRankingServiceInterface;
use Redis;
use RedisException;

class UserRankingService implements UserRankingServiceInterface
{
    /**
     * @throws RedisException
     */
    public function updateScore($userId, $score)
    {
        Redis::zadd('user_scores', $score, $userId);
    }

    /**
     * @throws RedisException
     */
    public function getTopUsers($limit): array|Redis
    {
        return Redis::zrevrange('user_scores', 0, $limit - 1);
    }
}