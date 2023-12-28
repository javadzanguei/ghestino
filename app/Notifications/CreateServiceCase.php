<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class CreateServiceCase extends Notification
{
    use Queueable;
    public int $serviceCaseId;
    public string $serviceCaseModel;

    /**
     * Create a new notification instance.
     */
    public function __construct($case_id, $case_model)
    {
        $this->serviceCaseId = intval($case_id);
        $this->serviceCaseModel = $case_model;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('درخواست جدید')
            ->icon('/assets/images/favicon-64x64.png')
            ->body($this->serviceCaseModel)
            ->action('مشاهده درخواست', $this->serviceCaseId)
            ->options(['TTL' => 1000])
            ->lang('Persian');
        // ->data(['id' => $notification->id])
        // ->badge()
        // ->dir()
        // ->image()
        // ->renotify()
        // ->requireInteraction()
        // ->tag()
        // ->vibrate()
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
