<?php

declare(strict_types=1);

namespace ICaspar\Simple\Domain\Author;

use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Author
{
    public const AUTHOR_NAMESPACE = '94173f80-6dc6-40ca-b19b-0e2678ac3afb';

    private readonly UuidInterface $uuid;

    /**
     * Instantiate an Author.
     *
     * @param string $name
     * @param string $email
     * @param string $about
     * @param UuidInterface|string $uuid
     *
     * @throws InvalidUuidStringException
     */
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $about,
        UuidInterface|string $uuid = ''
    ) {
        $this->uuid = $this->sanitizeToUuid($uuid);
    }

    /**
     * Sanitize to a Uuid instance.
     *
     * @param UuidInterface|string $uuid
     *
     * @return UuidInterface
     *
     * @throws InvalidUuidStringException
     */
    private function sanitizeToUuid(UuidInterface|string $uuid): UuidInterface
    {
        $uuid = empty($uuid)
            ? Uuid::uuid5(self::AUTHOR_NAMESPACE, $this->name)
            : $uuid;

        return $uuid instanceof UuidInterface
            ? $uuid
            : Uuid::fromString($uuid);
    }
}
