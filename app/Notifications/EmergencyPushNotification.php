<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Factory;

class EmergencyPushNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $firebaseCredentialsPath = env('FIREBASE_CREDENTIALS');
        $firebase = (new Factory)
            ->withServiceAccount($firebaseCredentialsPath)
            ->create();

        $messaging = $firebase->getMessaging();

        $deviceToken = $notifiable->device_token; // Assuming you have a 'device_token' field in your User model

        $message = CloudMessage::new()
            ->withNotification([
                'title' => 'Emergency Alert',
                'body' => $this->emergencyMessage,
            ])
            ->withData(['emergency_message' => $this->emergencyMessage])
            ->withToken($deviceToken);

        $messaging->send($message);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
