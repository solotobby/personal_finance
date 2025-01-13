<?php

namespace App\Mail;

use App\Models\Staffs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PayslipMail extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;
    public $pdf_file_path;

    /**
     * Create a new message instance.
     *
     * @param Staffs $staff
     * @param string $pdf_file_path
     */
    public function __construct(Staffs $staff, $pdf_file_path)
    {
        $this->staff = $staff;
        $this->pdf_file_path = $pdf_file_path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Payslip for ' . $this->staff->name)
                    ->view('staffs.payslip')  // You can create a simple view for the email body
                    ->attach($this->pdf_file_path, [
                        'as' => 'Payslip_' . $this->staff->name . '.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
