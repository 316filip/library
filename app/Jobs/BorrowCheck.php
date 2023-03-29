<?php

namespace App\Jobs;

use App\Mail\BorrowNotification;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BorrowCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $id, $email;
    public function __construct($booking)
    {
        $this->id = $booking->id;
        $this->email = $booking->user->email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $booking = Booking::where('id', $this->id)->first();
        if (!$booking->borrowed && !$booking->returned) {
            // Cancel the booking
            $booking->update([
                'returned' => 1,
            ]);
            Mail::to($this->email)->send(new BorrowNotification($booking));
        } else {
            // Dispatch a reminder five days before the booking end
            dispatch(new ReturnNotify($booking))->delay(strtotime('-5 days', strtotime($booking->to)) - strtotime(now('Europe/Prague')));
        }
    }
}
