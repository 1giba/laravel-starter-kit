<?php

namespace App\Contracts;

interface ServiceInterface
{
    /**
     * Main method
     *
     * @param array $params
     * @return mixed
     */
    public function dispatch(array $params = []);
}