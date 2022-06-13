<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Form;
use App\Models\Authorization\User\User;
use App\Notifications\FormVerfiedNotification;
use Illuminate\Support\Facades\Notification;

class SendFormVerifiedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $form;
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
            $query->whereIn('id',[1,2]);
        })->get();

        // merge other related users of the organization
        $admins = $admins->merge($this->form->organization->users()->get());

        if($admins) {
            Notification::send($admins, new FormVerfiedNotification($this->form, route('admin.forms')));
        }
    }
}
