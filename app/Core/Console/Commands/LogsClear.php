<?php

declare(strict_types=1);

namespace Core\Console\Commands;

use Illuminate\Console\Command;

class LogsClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear laravel logs';

    public function handle(): void
    {
        exec('truncate -s 0 ' . storage_path('logs') . '/laravel.log');

        $this->info('Logs have been cleared!');
    }
}
