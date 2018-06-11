<?php

namespace App\Services\Users\Commands;

use App\Contracts\CommandInterface;

class ListUsers implements CommandInterface
{
    /**
     * @var array
     */
    protected $filters;

    /**
     * @param array $filters
     * @return void
     */
    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Get filters
     *
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }
}