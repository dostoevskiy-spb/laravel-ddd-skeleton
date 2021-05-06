<?php
declare(strict_types=1);

namespace Common\Providers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

/**
 * @method forPage(int|null $page, $perPage)
 * @method count()
 */
class CollectionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /*
         * Пример использования:
         *      collect($array)->paginate(15);
         */
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}
