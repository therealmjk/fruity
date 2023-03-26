<?php

namespace App\Service;

use Symfony\Component\HttpKernel\Log\Logger;

class BaseService
{

    public function __construct(public readonly Logger $logger)
    {
    }
}