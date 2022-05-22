<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Authorization\User\User;
use App\Notifications\UserAddedNotification;
use Illuminate\Support\Facades\Notification;

class SendUserAddedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        auth()->user()->notify(new UserAddedNotification($this->user, route('admin.users.index')));
        
        $admins = User::whereHas('roles', function ($query) {
                    $query->whereIn('id',[1,2]);
                })->get();
        
        if($admins) {
            Notification::send($admins,new UserAddedNotification($this->user, route('admin.users.index')));
        }
    }
}
