<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class AfterFruitsSavedEvent extends Event
{

    public const NAME = 'fruits.saved';
}