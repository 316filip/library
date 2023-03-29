<?php

namespace App\Jobs;

use App\Mail\ReturnWarning;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Mail;

class ReturnCheck implements ShouldQueue
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
        if ($booking->returned == 0 && date_diff(now('Europe/Prague'), date_create($booking->to))->format('%R%a') < 3) {
            // Alert the user about the end of the booking
            Mail::to($this->email)->send(new ReturnWarning($booking));
        }
    }
}
