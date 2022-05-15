<?php

declare(strict_types=1);

namespace ICaspar\Simple\Core\Author;

use ICaspar\Simple\Core\Ports\Repositories\AuthorRepository;
use ICaspar\Simple\Core\Ports\Services\AuthorService;

final class AuthorManager implements AuthorService
{
    public function __construct(private readonly AuthorRepository $repository)
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
        $author = new Author($name, $email, $about, $uuid);
        $this->repository->save($author);

        return $author;
    }

    /**
     * Get Author(s) by name.
     *
     * @param string $name
     *
     * @return Author[]
     */
    public function getByName(string $name): array
    {
        return $this->repository->getByName($name);
    }
}
