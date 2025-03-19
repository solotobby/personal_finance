<?php
namespace App\Mail;

use App\Models\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StaffAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;

    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function build()
    {
        return $this->subject('Welcome to the Team!')
                    ->view('emails.staff_account_created');
    }
}
