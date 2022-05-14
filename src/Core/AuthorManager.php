<?php

declare(strict_types=1);

namespace ICaspar\Simple\Core;

use ICaspar\Simple\Core\Author\Author;
use ICaspar\Simple\Core\Ports\Primary\AuthorService;
use ICaspar\Simple\Core\Ports\Secondary\AuthorRepository;
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
        $uuid = ! empty($uuid) ? $uuid : Uuid::uuid5(Author::NAMESPACE, $name);
        $author = new Author($name, $email, $about, $uuid);
        $this->repository->save($author);

        return $author;
    }
}
