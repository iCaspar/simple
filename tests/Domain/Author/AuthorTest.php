<?php

declare(strict_types=1);

namespace ICaspar\Simple\Tests\Domain\Author;

use ICaspar\Simple\Domain\Entities\Author;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

final class AuthorTest extends TestCase
{
    private Author $author;

    public function setUp(): void
    {
        $this->author = new Author(
            'Caspar Green',
            'caspar@example.com',
            'About me.'
        );
    }

    /**
     * @test
     */
    public function shouldReturnItsName(): void
    {
        $this->assertSame('Caspar Green', $this->author->name());
    }

    /**
     * @test
     */
    public function shouldReturnItsEmail(): void
    {
        $this->assertSame('caspar@example.com', $this->author->email());
    }

    /**
     * @test
     */
    public function shouldReturnItsAbout(): void
    {
        $this->assertSame('About me.', $this->author->about());
    }
}
