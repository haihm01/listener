<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $data = [
            'name' => $event->order,
            // 'order' => $event->order
        ];
   
        Mail::send('mail', $data, function($message) {
         $message->to('haidx4581@gmail.com', 'Hoàng Minh Hải')
                 ->subject('Đặt hàng thành công');
        });
        Log::debug("Basic Email Sent. Check your inbox.");
    }
}