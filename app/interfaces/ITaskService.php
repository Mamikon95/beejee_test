<?php

namespace app\interfaces;

interface ITaskService
{
    public function getAllTasks(int $limit, int $offset, string $searchText = ''): array;

    public function getAllTasksCount(string $searchText = ''): int;

    public function getTaskById(int $id): array;

    public function add(): bool;

    public function edit(): bool;
}