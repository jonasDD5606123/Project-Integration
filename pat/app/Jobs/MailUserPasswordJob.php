<?php
namespace App\Jobs;

use App\Models\Gebruiker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Password;

class MailUserPasswordJob implements ShouldQueue
{
    use Queueable;

    public $gebruiker;

    public function __construct(Gebruiker $gebruiker)
    {
        $this->gebruiker = $gebruiker;
    }

    public function handle()
    {
        // Send password reset link using Laravel's built-in mechanism
        Password::broker()->sendResetLink([
            'email' => $this->gebruiker->email,
        ]);
    }
}
