<?php

namespace App\Services\Notification;


use App\Models\PushNotification;

class PushNotificationService
{
    public function sendPushNotification($userId, $message): void
    {
        PushNotification::query()->create([
            'user_id' => $userId,
            'message' => $message,
        ]);
    }
}