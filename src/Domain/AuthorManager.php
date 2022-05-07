<?php

declare(strict_types=1);

namespace ICaspar\Simple\Domain;

use ICaspar\Simple\Domain\Entities\Author;
use ICaspar\Simple\Domain\Ports\Primary\AuthorService;
use ICaspar\Simple\Domain\Ports\Secondary\AuthorRepository;
use Ramsey\Uuid\Uuid;

final class AuthorManager implements AuthorService
{
    public function __construct(private AuthorRepository $repository)
    {
    }

    /**
     * Create an author.
     *
     * @param string $name
     * @param string $email
     * @param string $about
     * @param string $uuid
     *
     * @return Author
     */
    public function create(string $name, string $email, string $about, string $uuid = ''): Author
    {
        $uuid = ! empty($uuid) ? $uuid : Uuid::uuid5(Author::AUTHOR_NAMESPACE, $name);
        $author = new Author($name, $email, $about, $uuid);
        $this->repository->save($author);

        return $author;
    }
}
