<?php

namespace app\services;

use app\interfaces\IPaginationService;

class PaginationService implements IPaginationService
{
    protected int $page = 1;
    protected int $pageSize = 3;
    protected int $count = 0;
    protected int $limitOfpages = 6;

    public function setPage(int $page): void
    {
        $this->page = $page > 0 ? $page : $this->page;
    }

    public function setPageSize(int $pageSize): void
    {
        $this->pageSize = $pageSize;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function getLimit(): int
    {
        return $this->pageSize;
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->pageSize;
    }

    public function getMaxPage(): int
    {
        return (int)round($this->count / $this->pageSize);
    }

    public function getCurrentPage(): int
    {
        return $this->page;
    }

    public function getNextPage(): int
    {
        return $this->page >= $this->getMaxPage() ? $this->page : ($this->page + 1);
    }

    public function getPrevPage(): int
    {
        return $this->page <= 1 ? $this->page : ($this->page - 1);
    }

    public function getLimitOfPages(): int
    {
        return !$this->isMoreThanLimit() ? $this->getMaxPage() : $this->limitOfpages;
    }

    public function isMoreThanLimit(): bool
    {
        return $this->limitOfpages < $this->getMaxPage();
    }
}