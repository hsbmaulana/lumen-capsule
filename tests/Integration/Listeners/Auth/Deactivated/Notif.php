<?php

namespace Tests\Integration\Listeners\Auth\Deactivated;

use Tests\Integration\Events\Auth\Deactivated as Event;

use Illuminate\Queue\InteractsWithQueue as InteractionTrait;
use Illuminate\Contracts\Queue\ShouldQueue as AsyncableContract;

use Illuminate\Bus\Queueable as QueueTrait;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;

class Notif implements AsyncableContract
{
    use InteractionTrait;

    /**
     * @var int
     */
    public $delay = 10;

    /**
     * @param \Tests\Integration\Events\Auth\Deactivated $event
     * @return void
     */
    public function handle(Event $event)
    {
        $event->data->notify(new Notice($event->data));
    }

    /**
     * @param \Tests\Integration\Events\Auth\Deactivated $event
     * @param \Throwable $exception
     * @return void
     */
    public function failed(Event $event, $exception)
    {
        //
    }
}

class Notice extends Notification implements AsyncableContract
{
    use QueueTrait;

    /**
     * @return string
     */
    public function broadcastType()
    {
        return 'setting.deactivation';
    }

    /**
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ 'mail', ];
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())->level('success')->subject(trans('notification.deactivation.mail.subject'))->line(trans('notification.deactivation.mail.object'));
    }
}