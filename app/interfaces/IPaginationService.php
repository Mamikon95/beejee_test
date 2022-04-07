<?php

namespace app\interfaces;

interface IPaginationService
{
    public function setPageSize(int $pageSize): void;

    public function getPageSize(): int;

    public function setPage(int $page): void;

    public function getCurrentPage(): int;

    public function getNextPage(): int;

    public function getPrevPage(): int;

    public function setCount(int $count): void;

    public function getOffset(): int;

    public function getLimit(): int;

    public function getMaxPage(): int;

    public function getLimitOfPages(): int;

    public function isMoreThanLimit(): bool;
}