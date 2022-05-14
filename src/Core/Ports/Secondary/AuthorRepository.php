<?php

declare(strict_types=1);

namespace ICaspar\Simple\Core\Ports\Secondary;

use ICaspar\Simple\Core\Author\Author;

interface AuthorRepository
{
    public function save(Author $author): void;
}
