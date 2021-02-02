<?php

declare(strict_types=1);

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ComponentsWipe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'components:wipe {--f|force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wipe all components tables';

    public function handle(): void
    {
        if ($this->isConfirmed() === false) {
            $this->info('Components wipe was canceled');
        }

        $connection = env('DB_CONNECTION');

        $this->setConnection($connection);

        $this->wipeComponents(config('components'));

        $this->info('All components wiped');
    }

    protected function isConfirmed(): bool
    {
        if ($this->option('force')) {
            return true;
        }

        if ($this->confirm('Do you wish to wipe database ? (yes|no) [no]', false) === false) {
            return false;
        }

        return true;
    }

    protected function wipeComponents(array $components): void
    {
        if (empty($components) === false) {
            foreach ($components as $component) {
                $this->dropSchema($component['schema']);
            }
        }
    }

    protected function dropSchema(string $schema): void
    {
        DB::statement("DROP SCHEMA IF EXISTS ${schema} CASCADE");
    }

    protected function setConnection(string $connection): void
    {
        try {
            DB::connection($connection);
        } catch (InvalidArgumentException $exception) {
            $message = $exception->getMessage();

            $this->error($message);
        }
    }
}
