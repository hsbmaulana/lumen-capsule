<?php

namespace Tests\Integration\Listeners\Auth\Activated;

use Tests\Integration\Events\Auth\Activated as Event;

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
     * @param \Tests\Integration\Events\Auth\Activated $event
     * @return void
     */
    public function handle(Event $event)
    {
        $event->data->notify(new Notice($event->data));
    }

    /**
     * @param \Tests\Integration\Events\Auth\Activated $event
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
     * @var \App\Models\User
     */
    protected $data;

    /**
     * @param \App\Models\User
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function broadcastType()
    {
        return 'auth.activation';
    }

    /**
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ 'broadcast', 'database', 'mail', ];
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([ 'data' => [ 'id' => $notifiable->id, 'username' => $notifiable->name, 'message' => trans('notification.activation.title'), ], ]);
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([ 'id' => $notifiable->id, 'username' => $notifiable->name, 'message' => trans('notification.activation.title'), ]);
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())->level('success')->subject(trans('notification.activation.mail.subject'))->line(trans('notification.activation.mail.object', [ 'id' => $notifiable->id, 'username' => $notifiable->name, ]));
    }
}