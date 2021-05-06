<?php

declare(strict_types=1);

namespace Components\Contractor\Providers;

use Components\Contractor\Interfaces\ContractorRepositoryInterface;
use Components\Contractor\Interfaces\ContractorServiceInterface;
use Components\Contractor\Repositories\ContractorRepository;
use Components\Contractor\Services\ContractorService;
use Illuminate\Support\ServiceProvider;

class ContractorProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ContractorServiceInterface::class, ContractorService::class);
        $this->app->bind(ContractorRepositoryInterface::class, ContractorRepository::class);
    }
}
