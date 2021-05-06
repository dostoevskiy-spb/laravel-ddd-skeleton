<?php

declare(strict_types=1);

namespace Core\Console\Commands;

use File;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ComponentGenerate extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'component:generate-stubs { componentName }  { --part } { --type }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate component parts';

    protected string $component;
    protected const PARTS = [
//        'component',
//        'model',
//        'controller',
        'routes-common',

    ];
    protected const TYPES = [];

    public function handle()
    {
        $this->component = $this->argument('componentName');
        foreach (self::PARTS as $part) {
            if ($this->isReservedName($this->getNameInput())) {
                $this->error('The name "' . $this->getNameInput() . '" is reserved by PHP.');

                return false;
            }

            $name = $this->qualifyClass(ucfirst(trim($part)));
            $namespace = $this->getDefaultPartNamespace($name, $part);
            $path = $this->getComponentPartPath($namespace, $part);
            dd($path);
            // Next, We will check to see if the class already exists. If it does, we don't want
            // to create the class and overwrite the user's code. So, we will bail out so the
            // code is untouched. Otherwise, we will continue generating this class' files.
            if ((!$this->hasOption('force') ||
                 !$this->option('force')) &&
                $this->alreadyExists($this->getNameInput())) {
                $this->error($this->type . ' already exists!');

                return false;
            }

            // Next, we will generate the path to the location where this class' file should get
            // written. Then, we will build the class and make the proper replacements on the
            // stub files so that it gets the correctly formatted namespace and class name.
            $this->makeDirectory($path);

            $this->files->put($path, $this->sortImports($this->buildClass($name)));

            $this->info($this->type . ' created successfully.');
        }
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param string $name
     *
     * @return string
     */
    protected function qualifyClass($name)
    {
        $part = $name;
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);
        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }
        switch (lcfirst($part)) {
            case 'component':
                $namespace = $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\';
        }
        $namespace = $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\';

        return $this->qualifyClass(
            $namespace
        );
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getComponentPartPath(string $name, string $part)
    {
        $path = $this->laravel['path'] . '/' . str_replace('\\', '/', $name);

        return match ($part) {
            'component' => $path . ucfirst($this->component) . '.php',
//            'controller' => $path .
            default => $path . '/' .ucfirst($this->component) . ucfirst($part) . '.php'
        };
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        if ($this->part && File::exists(__DIR__ . "/../Stubs/{$this->part}.stub")) {
            $stub = "/Stubs/Component/{$this->part}.stub";
        } else {
            $stub = "/../Stubs/Component/component.stub";
        }

        return $this->resolveStubPath($stub);
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput(): string
    {
        return ucfirst(trim($this->component));
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param string $stub
     *
     * @return string
     */
    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultPartNamespace(string $rootNamespace, string $part, string $type = null): string
    {
        return match ($part) {
            'http' => $rootNamespace . "\Http\Versions\{$type}\v1\Controllers",
            'component' => $rootNamespace,
            'provider' => $rootNamespace . "\Providers",
            default => $rootNamespace . ucfirst($part),
        };
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace(): string
    {
        return 'Components\\' . ucfirst($this->component);
    }


    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            ['type', 't', InputOption::VALUE_NONE, 'Specify component http type name to generate', 'Open'],
            ['part', 'p', InputOption::VALUE_NONE, 'Specify component part name to generate', 'component'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['componentName', InputArgument::REQUIRED, 'Specify component name to generate'],
        ];
    }
}
