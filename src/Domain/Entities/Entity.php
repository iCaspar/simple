<?php

declare(strict_types=1);

namespace ICaspar\Simple\Domain\Entities;

use Ramsey\Uuid\UuidInterface;

abstract class Entity
{
    use EntityTrait;
}
