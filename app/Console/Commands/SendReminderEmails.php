<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking; // Replace with your Booking model
use App\Mail\ReminderEmail; // Replace with your reminder email Mailable
use App\Models\SlotBook;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

class SendReminderEmails extends Command
{
    protected $signature = 'reminder:send';

    protected $description = 'Send reminder emails to users for upcoming bookings.';

    public function handle()
    {
        $bookings = SlotBook::where('booking_time', '>', Carbon::now())
            ->where('booking_time', '<=', Carbon::now()->addHours(2))
            // ->where('reminder_sent', false)
            ->get();
    
        foreach ($bookings as $booking) {
            $user = $booking->user;
    
            // Convert booking_time string to a Carbon instance
            $bookingTime = Carbon::parse($booking->booking_time);
    
            // Calculate the two reminder dates/times before the booking time
            $firstReminderTime = $bookingTime->subHours(1); // First reminder 1 hour before booking time
            $secondReminderTime = $bookingTime->subMinutes(30); // Second reminder 30 minutes before booking time
    
            // Send the first reminder email if the current time is after the first reminder time
            if (Carbon::now() > $firstReminderTime) {
                Mail::to($user->email)->send(new ReminderEmail($booking, 'First'));
            }
    
            // Send the second reminder email if the current time is after the second reminder time
            if (Carbon::now() > $secondReminderTime) {
                Mail::to($user->email)->send(new ReminderEmail($booking, 'Second'));
            }
    
            // Update the booking status or perform any other necessary actions
            $booking->reminder_sent = true;
            $booking->save();
        }
    
        $this->info('Reminder emails sent successfully.');
    }
}
