<?php

declare(strict_types=1);

namespace ICaspar\Simple\Domain\Ports\Secondary;

use ICaspar\Simple\Domain\Entities\Author;

interface AuthorRepository
{
    public function save(Author $author): void;
}
