<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Form;

class FormUpdatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Form $form, $url)
    {
        $this->form = $form;
        $this->redirect_url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail, database'];
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
                    ->line('Form is being updated by organization ' . $this->form->organization->name . ' for year '. $this->form->year)
                    ->action('Click me to view', url($this->redirect_url))  
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $user = auth()->user();
        $roles = $user->roles->pluck('id');
        // if auth user has role User
        if($roles->contains(3)){
            return [
                'message' => 'Form is being updated by organization ' . $this->form->organization->name . ' for year '. $this->form->year,
                'url' => $this->redirect_url,
            ];
        }
        // if auth user has role Auditor
        elseif($roles->contains(4)){
            return [
                'message' => 'Form is being audited of organization ' . $this->form->organization->name . ' for year '. $this->form->year,
                'url' => $this->redirect_url,
            ];
        }
        // if auth user has role OrgAdmin
        elseif($roles->contains(5)){
            return [
                'message' => 'Form is being updated by organization ' . $this->form->organization->name . ' for year '. $this->form->year,
                'url' => $this->redirect_url,
            ];
        }
        // if auth user has role FinalVerifier
        elseif($roles->contains(6)){
            return [
                'message' => 'Form is being verified of organization ' . $this->form->organization->name . ' for year '. $this->form->year,
                'url' => $this->redirect_url,
            ];
        }
        
    }
}
