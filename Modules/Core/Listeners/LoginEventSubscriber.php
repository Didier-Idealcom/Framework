<?php

namespace Modules\Core\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Events\Dispatcher;

class LoginEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserLogin(Login $event): void
    {
        if ($event->user->isAdmin()) {
            session()->put('locale', $event->user->lang);
            session()->put('domain', $event->user->domains->first()->id);
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            Login::class => 'handleUserLogin',
        ];
    }
}
