<?php

namespace core\interfaces;

interface IDb
{
    public function getConnection(): \PDO;
}