<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Form;
use App\Models\Authorization\User\User;
use App\Notifications\FormUpdatedNotification;
use Illuminate\Support\Facades\Notification;

class SendFormUpdatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admins = User::whereHas('roles', function ($query) {
            $query->whereIn('id',2);
        })->get();

        if($admins) {
            Notification::send($admins, new FormUpdatedNotification($this->form, route('admin.forms')));
        }
    }
}
