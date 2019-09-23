<?php
namespace Labizon;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class MobizonChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var \Labizon\MobizonMessage $message */
        $message = $notification->toMobizon($notifiable);

        if (!$message->hasRecipient()) {
            $message->to($notifiable->routeNotificationFor('mobizon', $notification));
        }

        /** @var \Labizon\MobizonClient $api */
        $api = app(MobizonClient::class);

        if (!$api->send($message)) {
            Log::error('Message NOT send', $api->context());
        } else {
            Log::info('Message send: ', $api->context());
        }
    }
}