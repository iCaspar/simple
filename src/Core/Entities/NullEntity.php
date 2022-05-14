<?php

declare(strict_types=1);

namespace ICaspar\Simple\Core\Entities;

use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class NullEntity extends Entity
{
    /**
     * Instantiate a Null Entity.
     *
     * @param string $key
     * @param UuidInterface|string $uuid
     *
     * @throws InvalidUuidStringException
     */
    public function __construct(string $key, UuidInterface|string $uuid = '')
    {
        $this->uuid = $this->sanitizeToUuid($uuid, Uuid::NIL, $key);
    }
}
