<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class ApprovalServiceLevel extends Notification
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

    public function via(object $notifiable): array
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('تأیید/رد مرحله درخواست')
            ->icon('/assets/images/favicon-64x64.png')
            ->body($this->serviceCaseModel)
            ->action('مشاهده درخواست', $this->serviceCaseId)
            ->options(['TTL' => 1000])
            ->lang('Persian');
    }
}
