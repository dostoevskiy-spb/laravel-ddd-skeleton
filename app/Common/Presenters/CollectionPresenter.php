<?php

declare(strict_types=1);

namespace Common\Presenters;

use Common\Presenters\Interfaces\PresenterInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

abstract class CollectionPresenter implements PresenterInterface
{
    protected const DEFAULT_PAGE = 1;
    protected const DEFAULT_PER_PAGE = 10;

    /**
     * @var string
     */
    public $itemsIndex = 'items';

    /**
     * @var int
     */
    protected $pagesCount;

    /**
     * @var int
     */
    protected $currentPage;

    /**
     * @var int
     */
    protected $perPage;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var bool
     */
    protected $pagination = false;

    /**
     * @var int
     */
    protected $elementsCount = 0;

    /**
     * BannedAccountsPresenter constructor.
     */
    public function __construct(?Collection $collection = null, ?array $pagination = null)
    {
        if (!$this->pagination) {
            $this->collection = $collection;

            return;
        }

        $page = isset($pagination['current_page']) ? (int) $pagination['current_page'] : static::DEFAULT_PAGE;
        $perPage = isset($pagination['per_page']) ? (int) $pagination['per_page'] : static::DEFAULT_PER_PAGE;

        $this->elementsCount = $collection->count();

        $this->collection = $this->paginate(
            $collection,
            $page,
            $perPage
        );
    }

    /**
     * Make paginated collection
     *
     *
     */
    protected function paginate(Collection $collection, int $page, int $perPage): Collection
    {
        $paginated = $collection->forPage($page, $perPage);

        $this->pagesCount = round($collection->count() / $perPage, 0, PHP_ROUND_HALF_UP);
        if ($this->pagesCount < 1) {
            $this->pagesCount = 1;
        }

        $this->currentPage = $page;

        $this->perPage = $perPage;

        return $paginated;
    }

    public function present(bool $toResponse = true)
    {
        $presentationData = $this->getPresentationData();

        if ($this->pagination) {
            $presentationData['pagination'] = [
                'current_page' => $this->currentPage,
                'elements_count' => $this->elementsCount,
                'pages_total' => $this->pagesCount,
                'per_page' => $this->perPage,
            ];
        }

        if ($toResponse === false) {
            return new Collection($presentationData[$this->itemsIndex]);
        }

        return response()
            ->json($presentationData);
    }

    abstract protected function getPresentationData(): array;
}
