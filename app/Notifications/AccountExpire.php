<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Log;

class AccountExpire extends Notification implements ShouldQueue
{
    use Queueable;

    private $days;

    public function __construct($expired_at)
    {
        $this->days = now()->diffInDays($expired_at);
        $this->expired_day =  $expired_at; // ->format('Y-m-d');
    }

    public function via($notifiable)
    {
        // \Log::debug(sysConfig('account_expire_notification'));
     // return ['mail', 'database'];
     
     //$setting =json_decode(sysConfig('account_expire_notification'));
    // \Log::debug($setting);
       return json_decode(sysConfig('account_expire_notification'));
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('notification.account_expired'))
            ->line(trans('notification.account_expired_content', ['days' => $this->days]))
            ->action(trans('notification.view_web'), url('/'));
    }

    public function toDataBase($notifiable)
    {
       
      //  \Log::debug(sysConfig('account_expire_notification'));
        
        return [
            
            'title' => 'message.accountexpire.title',
            'content' => "message.accountexpire.content",
            'type'   => "notification",
            'days'  => $this->days,
            
        ];
    }

    public function toCustom($notifiable)
    {
        return [
            'title'   => trans('notification.account_expired'),
            'content' => trans('notification.account_expired_content', ['days' => $this->days]),
        ];
    }
}
