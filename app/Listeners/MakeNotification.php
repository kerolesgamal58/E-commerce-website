<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use function App\Helper\getCurrentUserId;

class MakeNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        $user_id = getCurrentUserId();
        Notification::create([
            'user_id' => $user_id,
            'title' => 'a new order',
            'content' => __('admin.have_new_order') . $event->order->address,
            'read' => 'unread'
        ]);
    }
}
