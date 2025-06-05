<?php

namespace App\Jobs;

use App\Models\Gebruiker;
use App\Models\StudentKlassen;
use Illuminate\Support\Facades\Hash;
use App\Mail\NewUserMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class MailUserPasswordJob implements ShouldQueue
{
    use Queueable;

    public $gebruiker;
    public $password;

    public function __construct($gebruiker, $password)
    {
        $this->gebruiker = $gebruiker;
        $this->password = $password;
    }

    public function handle()
    {
        // Hash the password
        $this->gebruiker->password = Hash::make($this->password);
        $this->gebruiker->save();

        // Send the email with the password
        Mail::to($this->gebruiker->email)->send(new NewUserMail($this->gebruiker->email, $this->password));
    }
}
