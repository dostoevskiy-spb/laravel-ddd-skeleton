<?php

namespace Common\Database\Seeds;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function __invoke(array $parameters = [])
    {
        if (!method_exists($this, 'run')) {
            throw new InvalidArgumentException('Method [run] missing from ' . get_class($this));
        }

        try {
            $result = isset($this->container)
                ? $this->container->call([$this, 'run'])
                : $this->run();
        } catch (QueryException $exception) {
//            dd($exception->getMessage());
            $seeder = class_basename(static::class);

            $this->command->info("$seeder is already seeded");

            return false;
        }

        return $result;
    }

    /**
     * Seed the given connection from the given path.
     *
     * @param  array|string  $class
     * @param  bool  $silent
     * @return $this
     */
    public function call($class, $silent = false, array $parameters = [])
    {
        $classes = Arr::wrap($class);

        foreach ($classes as $class) {
            $seeder = $this->resolve($class);

            $name = get_class($seeder);

            if ($silent === false && isset($this->command)) {
                $this->command->getOutput()->writeln("<comment>Seeding:</comment> {$name}");
            }

            $seeder->__invoke($parameters);
        }

        return $this;
    }
}
