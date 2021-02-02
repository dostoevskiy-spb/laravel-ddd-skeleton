<?php

declare(strict_types=1);

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ComponentsInit extends Command
{
    /**
     * Relative path to migrations
     *
     * @var string
     */
    protected $migrationsPath = '/Database/Migrations/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'components:init { --name= }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle(): void
    {
        $components = config('components');
        if (empty($components)) {
            echo 'Has no components in config' . PHP_EOL;

            return;
        }

        $componentName = $this->option('name');
        if ($componentName) {
            if (isset($components[$componentName]) === false) {
                $this->comment("$componentName is wrong or not exists in components configuration.");

                return;
            }

            $this->migrateComponent($componentName);
            $this->seedComponent($componentName);

            return;
        }

        foreach (array_keys($components) as $name) {
            $this->call('components:init', ['--name' => $name]);
        }

        return;
    }

    protected function seedComponent(string $name): void
    {
        $settings = config("components.$name");

        if (isset($settings['seeder'])) {
            $this->call('db:seed', ['--class' => $settings['seeder']]);
        }
    }

    protected function migrateComponent(string $name): void
    {
        $settings = config("components.$name");

        $migrationsPath = $this->getMigrationsPath($settings['model']);

        $this->createSchema($settings['schema']);

        try {
            $this->call('migrate:status');
        } catch (QueryException $exception) {
            $this->call('migrate:install');
        }

        $this->call('migrate', ['--path' => $migrationsPath]);
    }

    protected function getMigrationsPath(string $model): string
    {
        $exploded = explode('\\', $model);

        array_pop($exploded);

        return '/app/' . implode('/', $exploded) . $this->migrationsPath;
    }

    protected function createSchema(string $name): void
    {
        $this->setSchema($name);

        DB::connection()->statement("CREATE SCHEMA IF NOT EXISTS ${name}");
    }

    private function setSchema(string $name): void
    {
        $connection = env('DB_CONNECTION');

        config(["database.connections.${connection}.schema" => $name]);

        DB::connection()->statement("SET search_path TO {$name}");
    }
}
