<?php

declare(strict_types=1);

namespace ICaspar\Simple\Domain\Entities;

use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Author extends Entity
{
    public const AUTHOR_NAMESPACE = '94173f80-6dc6-40ca-b19b-0e2678ac3afb';

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
        $this->uuid = $this->sanitizeToUuid(
            $uuid,
            self::AUTHOR_NAMESPACE,
            $name
        );
    }

    /**
     * Return the name.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Return the email.
     *
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * Return the about.
     *
     * @return string
     */
    public function about(): string
    {
        return $this->about;
    }
}
