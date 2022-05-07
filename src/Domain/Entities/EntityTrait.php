<?php

declare(strict_types=1);

namespace ICaspar\Simple\Domain\Entities;

use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait EntityTrait
{
    protected UuidInterface $uuid;

    /**
     * Get the uuid.
     *
     * @return string
     */
    public function id(): string
    {
        return $this->uuid->toString();
    }

    /**
     * Sanitize to a Uuid instance.
     *
     * @param UuidInterface|string $uuid
     * @param string $namespace
     * @param string $key
     *
     * @return UuidInterface
     * @throws InvalidUuidStringException
     *
     */
    protected function sanitizeToUuid(
        UuidInterface|string $uuid,
        string $namespace,
        string $key
    ): UuidInterface {
        $uuid = empty($uuid)
            ? Uuid::uuid5($namespace, $key)
            : $uuid;

        return $uuid instanceof UuidInterface
            ? $uuid
            : Uuid::fromString($uuid);
    }

    /**
     * Check that another Entity's Uuid matches.
     *
     * @param Entity $entity
     *
     * @return bool
     */
    public function isSame(Entity $entity): bool
    {
        return $this->uuid->equals($entity->uuid);
    }
}
