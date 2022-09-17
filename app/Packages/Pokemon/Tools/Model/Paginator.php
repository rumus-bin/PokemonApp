<?php

namespace Pokemon\Tools\Model;

use App\Core\Database\Query\QueryModifierInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator as PaginatorAlias;

class Paginator implements QueryModifierInterface
{
    public const DEFAULT_PAGE = 1;
    public const DEFAULT_PER_PAGE = 20;

    public function __construct(
        private ?int $page = self::DEFAULT_PAGE,
        private ?int $perPage = self::DEFAULT_PER_PAGE
    ) {
    }

    public function page(): int
    {
        return $this->page ?? self::DEFAULT_PAGE;
    }

    public function perPage(): int
    {
        return $this->perPage ?? self::DEFAULT_PER_PAGE;
    }

    /**
     * @param int|null $page
     */
    public function setPage(?int $page): void
    {
        $this->page = $page ?? self::DEFAULT_PAGE;
    }

    /**
     * @param int|null $perPage
     */
    public function setPerPage(?int $perPage): void
    {
        $this->perPage = $perPage ?? self::DEFAULT_PER_PAGE;
    }



    public function modify(Builder $builder): LengthAwarePaginator
    {
        $count = $builder->count();
        $items = $builder->forPage($this->page(), $this->perPage())->get();

        return new LengthAwarePaginator(
            $items,
            $count,
            $this->perPage(),
            $this->page(),
            ['path' => PaginatorAlias::resolveCurrentPath()]
        );
    }
}
