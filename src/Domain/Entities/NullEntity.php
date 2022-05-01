<?php

declare(strict_types=1);

namespace ICaspar\Simple\Domain\Entities;

use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\UuidInterface;

final class NullEntity extends Entity
{
    /**
     * @param UuidInterface|string $uuid
     * @param string $namespace
     * @param string $key
     *
     * @throws InvalidUuidStringException
     */
    public function __construct(
        UuidInterface|string $uuid,
        string $namespace,
        string $key
    ) {
        $this->uuid = $this->sanitizeToUuid($uuid, $namespace, $key);
    }
}
