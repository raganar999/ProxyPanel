<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterReward extends Notification implements ShouldQueue
{
    use Queueable;

    private $percent;

    public function __construct($data, $freeTime)
    {
        $this->data = $data;
        $this->freeTime =$freeTime;
    }

    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDataBase($notifiable)
    {
        return [
            'title' => "message.registerreward.title",
            'content' => "message.registerreward.content",
            'type'   => "dialog",
            'percent' => $this->percent,
        ];
    }
}
