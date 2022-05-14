<?php

declare(strict_types=1);

namespace ICaspar\Simple\Core\Ports\Primary;

use ICaspar\Simple\Core\Author\Author;
use ICaspar\Simple\Core\Collections\AuthorCollection;

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
