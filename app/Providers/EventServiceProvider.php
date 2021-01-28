<?php

namespace App\Providers;

use App\Events\OrderShipped;
use App\Listeners\MakeNotification;
use App\Models\Order;
use App\Models\Setting;
use App\Observers\OrderObserver;
use App\Observers\SettingsObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderShipped::class => [
            MakeNotification::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Setting::observe(SettingsObserver::class);
        Order::observe(OrderObserver::class);
    }
}
