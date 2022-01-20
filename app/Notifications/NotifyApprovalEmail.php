<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class NotifyApprovalEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage;

        $message->success()
            ->subject('未承認データがあります。確認して下さい。');

        if (isset($this->data['over_time']))
            $message->line('時間外申請 (' . $this->data['over_time'] . ')')
                ->line(env('APP_URL') . 'approver/over-time');

        if (isset($this->data['part_time']))
            $message->line('パート申請 (' . $this->data['part_time'] . ')')
                ->line(env('APP_URL') . 'approver/part-time');

        if (isset($this->data['vacation']))
            $message->line('休暇申請 (' . $this->data['vacation'] . ')')
                ->line(env('APP_URL') . 'approver/vacation');


        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
