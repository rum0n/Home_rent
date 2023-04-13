<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminNewPost extends Notification
{
    use Queueable;
    public $last_post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($last_post)
    {
        $this->last_post = $last_post;
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
        return (new MailMessage)
            ->subject('New Post Added!')
            ->greeting('Hello, Mr.Admin')
            ->line('New post has been added.')
            ->line('Post Title : ' . $this->last_post->post_title)
            ->line('To show the post cleck here..')
            ->action('Show post', url(route('user.post.show',$this->last_post->id)));
            
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
