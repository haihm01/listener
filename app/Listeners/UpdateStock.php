<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStock
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
        $product1 = $event->order['product_name'];
        $product = Stock::query()->where('product_name',$product1)->firstOrFail();
        $product['quantity'] =  $product['quantity'] - 1;
        $data = [
            'product_name' => $product['product_name'],
            'quantity' => $product['quantity']
        ];
        // dd($product['quantity']);
        $product->update($data);
    }
}