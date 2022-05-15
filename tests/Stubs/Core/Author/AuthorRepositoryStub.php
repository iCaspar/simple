<?php

declare(strict_types=1);

namespace ICaspar\Simple\Tests\Stubs\Core\Author;

use ICaspar\Simple\Core\Author\Author;
use ICaspar\Simple\Core\Ports\Secondary\AuthorRepository;

final class AuthorRepositoryStub implements AuthorRepository
{
    public function save(Author $author): void
    {
    }
}
