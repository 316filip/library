<?php

namespace App\Jobs;

use App\Mail\ReturnNotification;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ReturnNotify implements ShouldQueue
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
        if ($booking->returned == 0 && date_diff(now('Europe/Prague'), date_create($booking->to))->format('%R%a') < 10) {
            Mail::to($this->email)->send(new ReturnNotification($booking));
            dispatch(new ReturnCheck($booking))->delay(strtotime($booking->to) - strtotime(now('Europe/Prague')));
        }
    }
}
