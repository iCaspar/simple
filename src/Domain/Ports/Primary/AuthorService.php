<?php

declare(strict_types=1);

namespace ICaspar\Simple\Domain\Ports\Primary;

use ICaspar\Simple\Domain\Collections\AuthorCollection;
use ICaspar\Simple\Domain\Entities\Author;

interface AuthorService
{
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
    public function create(string $name, string $email, string $about, string $uuid = ''): Author;
}
