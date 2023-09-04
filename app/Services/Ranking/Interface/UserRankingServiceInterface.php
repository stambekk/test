<?php

namespace App\Services\Ranking\Interface;

interface UserRankingServiceInterface
{
    public function updateScore($userId, $score);

    public function getTopUsers($limit);
}