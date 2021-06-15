<?php

namespace App\Notifications;

use Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NodeBlocked extends Notification implements ShouldQueue
{
    use Queueable;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return json_decode(sysConfigsysConfig('node_blocked_notification'));
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('notification.node_block'))
            ->markdown('mail.simpleMarkdown', ['title' => trans('notification.block_report'), 'content' => $this->markdownMessage(), 'url' => route('admin.node.index')]);
    }

    private function markdownMessage()
    {
        $content = '| '.trans('user.attribute.node').' | ICMP | TCP'." |\r\n| ------ | :------: | :------: |\r\n";
        $tail = '';
        foreach ($this->data as $node) {
            if (Arr::hasAny($node, ['icmp', 'tcp'])) {
                $content .= "| {$node['name']} | ".($node['icmp'] ?? '✔️').' | '.($node['tcp'] ?? '✔️')." |\r\n";
            }
            if (Arr::hasAny($node, ['message'])) {
                $tail .= "- {$node['name']}: {$node['message']}\r\n";
            }
        }

        return $content.$tail;
    }

    public function toCustom($notifiable)
    {
        return [
            'title'   => trans('notification.node_block'),
            'content' => $this->markdownMessage(),
        ];
    }
}
