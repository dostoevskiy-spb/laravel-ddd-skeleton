<?php

declare(strict_types=1);

namespace Core\Console\Commands;

use File;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ComponentsCreate extends Command
{
    /**
     * Relative path to migrations
     *
     * @var string
     */
    protected string $componentsPath = 'Components/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'components:create { --componentName= } { --access= }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create component directory structure  ';
    /**
     * @var array|string[]
     */
    private array $access = ['Admin', 'Open', 'Personal'];


    public function handle(): void
    {
        $componentName = $this->option('componentName');
        if (!$componentName) {
            $this->comment("Missing component name.");

            return;
        }

        $components = config('components.'  . $componentName);
        if (empty($components)) {
            $this->createComponentSettings($componentName);
        }

        $access = $this->option('access');
        if ($access) {
            $this->access = explode(',', $this->option('access'));
        }
        $this->createComponentSettings($componentName);
        $this->createComponentDirectory($componentName);
        $this->createCommonDirectories($componentName);
        $this->createDatabaseDirectory($componentName);
        $this->createHttpDirectory($componentName);
    }

    private function createCommonDirectories(string $componentName): void
    {
        $this->createDir(app_path($this->componentsPath . $componentName . '/Events'));
        $this->createDir(app_path($this->componentsPath . $componentName . '/Exceptions'));
        $this->createDir(app_path($this->componentsPath . $componentName . '/Interfaces'));
        $this->createDir(app_path($this->componentsPath . $componentName . '/Jobs'));
        $this->createDir(app_path($this->componentsPath . $componentName . '/Listeners'));
        $this->createDir(app_path($this->componentsPath . $componentName . '/Models'));
        $this->createDir(app_path($this->componentsPath . $componentName . '/Repositories'));
        $this->createDir(app_path($this->componentsPath . $componentName . '/Services'));
        $this->createDir(app_path($this->componentsPath . $componentName . '/Traits'));
        $this->createDir(app_path($this->componentsPath . $componentName . '/Providers'));
    }

    private function createDatabaseDirectory(string $componentName): void
    {
        $this->createDir(app_path($this->componentsPath . $componentName . '/Database/Factory'));
        $this->createDir(app_path($this->componentsPath . $componentName . '/Database/Migrations'));
        $this->createDir(app_path($this->componentsPath . $componentName . '/Database/Seeds'));
    }

    private function createComponentDirectory(string $componentName): void
    {
        $this->createDir(app_path($this->componentsPath . $componentName));
    }

    /**
     * @param string $path
     */
    private function createDir(string $path): void
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }

    private function createHttpDirectory(string $componentName): void
    {
        $this->createDir(app_path($this->componentsPath . $componentName . '/Http/Routes'));
        $this->createVersionDirectory($componentName);
    }

    private function createVersionDirectory(string $componentName): void
    {
        foreach ($this->access as $access) {
            $this->createDir(
                app_path($this->componentsPath . $componentName . "/Http/Versions/{$access}/v1/Controllers")
            );
            $this->createDir(
                app_path($this->componentsPath . $componentName . "/Http/Versions/{$access}/v1/Presenters")
            );
            $this->createDir(app_path($this->componentsPath . $componentName . "/Http/Versions/{$access}/v1/Requests"));
            $this->createDir(app_path($this->componentsPath . $componentName . "/Http/Versions/{$access}/v1/Routes"));
        }
    }

    private function createComponentSettings(string $componentName): void
    {
        $this->createDir(app_path('config/components'));
        $this->call('component:generate-stubs', ['componentName' => $componentName, 'part' => 'settings']);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            ['componentName', null, InputOption::VALUE_REQUIRED, 'Specify component name to generate'],
        ];
    }
}
