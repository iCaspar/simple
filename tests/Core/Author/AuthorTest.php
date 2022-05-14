<?php

declare(strict_types=1);

namespace ICaspar\Simple\Tests\Core\Author;

use ICaspar\Simple\Core\Author\Author;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Rfc4122\UuidV5;

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

    /**
     * @test
     */
    public function shouldReturnItsUuid(): void
    {
        $uuid = UuidV5::uuid5(Author::NAMESPACE, 'Caspar Greencaspar@example.com')->toString();

        $this->assertSame($uuid, $this->author->uuid());
    }
}
