<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class InquiryNotification extends Notification
{
    use Queueable;

    /**
     * @var Inquiry
     */
    private Inquiry $inquiry;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        Inquiry $inquiry
    ) {
        $this->inquiry = $inquiry;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->from("{$this->inquiry->email}")
            ->subject("{$this->inquiry->name}さんからお問い合わせがありました。")
            ->greeting("{$this->inquiry->name}さんからお問い合わせがありました。")
            ->line(Str::limit($this->inquiry->content, 255))
            ->action('お問い合わせを確認する', url('/admin/inquiries'))
            ->line('いつもご利用ありがとうございます。');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
