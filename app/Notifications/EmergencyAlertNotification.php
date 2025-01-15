<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\EmergencyAlert;

class EmergencyAlertNotification extends Notification
{
    use Queueable;

    protected $emergencyAlert;

    /**
     * Create a new notification instance.
     *
     * @param EmergencyAlert $emergencyAlert
     */
    public function __construct(EmergencyAlert $emergencyAlert)
    {
        $this->emergencyAlert = $emergencyAlert;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->emergencyAlert->title,
            'description' => $this->emergencyAlert->description,
            'location' => $this->emergencyAlert->location,
            'alert_time' => $this->emergencyAlert->alert_time,
            'category' => $this->emergencyAlert->category,
            'severity' => $this->emergencyAlert->severity,
            'source' => $this->emergencyAlert->source,
            // Add more fields as needed
        ];
    }
}
