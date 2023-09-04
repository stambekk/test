<?php

namespace App\Jobs;

use App\Services\Notification\PushNotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $userId;

    protected string $message;

    /**
     * @param $userId
     * @param $message
     */
    public function __construct($userId, $message)
    {
        $this->userId  = $userId;
        $this->message = $message;
    }

    /**
     * @param PushNotificationService $notificationService
     * @return void
     */
    public function handle(PushNotificationService $notificationService): void
    {
        $notificationService->sendPushNotification($this->userId, $this->message);
    }
}
