<?php

declare(strict_types=1);

namespace Core\Console;

use Core\Console\Commands\ComponentGenerate;
use Core\Console\Commands\ComponentsCreate;
use Core\Console\Commands\ComponentsInit;
use Core\Console\Commands\ComponentsWipe;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ComponentsInit::class,
        ComponentsWipe::class,
        ComponentsCreate::class,
        ComponentGenerate::class,
    ];

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        require base_path('routes/console.php');
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
//        $schedule->command('account-information:update')
//            ->cron('0 */2 * * *');
    }
}
