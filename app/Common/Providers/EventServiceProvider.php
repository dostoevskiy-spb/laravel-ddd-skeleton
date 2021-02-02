<?php

declare(strict_types=1);

namespace Common\Providers;

use Components\Account\Common\Events\AccountCloningFailed;
use Components\Account\Common\Events\AccountUpdated;
use Components\Account\Common\Events\AdvertisingPlatformTokenExpired;
use Components\Account\Common\Listeners\CheckInformation;
use Components\Account\Common\Listeners\MoveToUnsuitable;
use Components\AdvertisingPlatform\Common\Listeners\UpdateToken;
use Components\Email\Common\Events\EmailRegistered;
use Components\Email\Common\Listeners\ChangePasswords;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
    ];

    public function boot(): void
    {
        parent::boot();

        //
    }
}
