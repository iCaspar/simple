<?php

declare(strict_types=1);

namespace ICaspar\Simple\Core\Author;

use ICaspar\Simple\Core\Entities\Entity;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\UuidInterface;

final class Author extends Entity
{
    public const NAMESPACE = '94173f80-6dc6-40ca-b19b-0e2678ac3afb';

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
            self::NAMESPACE,
            $name . $email
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

    /**
     * Return the uuid.
     *
     * @return string
     */
    public function uuid(): string
    {
        return $this->uuid->toString();
    }
}
