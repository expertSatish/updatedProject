<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SlotBook;

class ReminderEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $booking;
    public $reminderType;

    /**
     * Create a new message instance.
     *
     * @param SlotBook $booking
     * @param string $reminderType
     */
    public function __construct(SlotBook $booking, string $reminderType)
    {
        $this->booking = $booking;
        $this->reminderType = $reminderType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Reminder for your booking';

        return $this->subject($subject)
            ->view('email.reminder')
            ->with([
                'booking' => $this->booking,
                'reminderType' => $this->reminderType,
            ]);
    }
}