<?php

namespace App\Http\Controllers\Api;

use App\Jobs\SendPushNotificationJob;
use App\Services\Ranking\Interface\UserRankingServiceInterface;
use App\Services\Ranking\Repository\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserRankingController extends ApiController
{
    /**
     * @param Request                     $request
     * @param UserRepository              $userRepository
     * @param UserRankingServiceInterface $rankingService
     * @param int                         $userId
     * @return JsonResponse
     */
    public function updateScore(
        Request                     $request,
        UserRepository              $userRepository,
        UserRankingServiceInterface $rankingService,
        int                         $userId
    )
    {
        $newScore = $request->get('score');
        $user     = $userRepository->updateScore($userId, $newScore);

        if ($user) {
            $rankingService->updateScore($userId, $newScore);

            return response()->json(['message' => 'Score updated']);
        }
        return response()->json(['message' => 'Score not updated']);
    }

    /**
     * @param Request                     $request
     * @param UserRankingServiceInterface $rankingService
     * @return JsonResponse
     */
    public function getTopUsers(Request $request, UserRankingServiceInterface $rankingService)
    {
        $limit    = $request->get('limit_score');
        $topUsers = $rankingService->getTopUsers($limit);

        return response()->json($topUsers);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendNotification(Request $request)
    {
        $userId  = $request->get('user_id');
        $message = $request->get('message');
        SendPushNotificationJob::dispatch($userId, $message);

        return response()->json(['message' => 'Notification sent']);
    }
}