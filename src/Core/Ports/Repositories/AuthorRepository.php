<?php

declare(strict_types=1);

namespace ICaspar\Simple\Core\Ports\Repositories;

use ICaspar\Simple\Core\Author\Author;

interface AuthorRepository
{
    /**
     * Save.
     *
     * @param Author $author
     */
    public function save(Author $author): void;

    /**
     * Get by name.
     *
     * @param string $name
     *
     * @return Author[]
     */
    public function getByName(string $name): array;
}
