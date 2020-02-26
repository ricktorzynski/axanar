<?php

namespace Ares\Listeners;

use Ares\Models\Campaigns;
use Ares\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class AuthenticationSubscriber
{
    /**
     * @param \Illuminate\Auth\Events\Login $event
     */
    public function onLogin(Login $event)
    {
        Log::debug('Login user', ['event' => $event]);

        /** @var User $user */
        $user = User::find($event->user->getAuthIdentifier());
        $campaignCount = count(Campaigns::getByUserId());
        session([
            'userId' => $user->user_id,
            'admin' => (int)$user->admin === 1,
            'hasStoreAccess' => $campaignCount > 0
        ]);

        User::where('user_id', $user->user_id)->update(['last_login' => Date::now()]);
        User::audit('loginOk', $user->user_id, 'user logged in');
    }

    /**
     * @param \Illuminate\Auth\Events\Logout $event
     */
    public function onLogout(Logout $event)
    {
        Log::debug('Logout user', ['event' => $event]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(Login::class, static::class . '@onLogin');
        $events->listen(Logout::class, static::class . '@onLogout');
    }
}
