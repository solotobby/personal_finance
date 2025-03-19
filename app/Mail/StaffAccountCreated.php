<?php
namespace App\Mail;

use App\Models\Staffs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StaffAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;
    public $password;

    public function __construct(Staffs $staff, $password)
    {
        $this->staff = $staff;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Welcome to the Team at '.$this->staff->business->business_name.'!')
                    ->view('emails.staff_account_created');
    }
}
