<?php

declare(strict_types=1);

namespace ICaspar\Simple\Tests\Domain\Author;

use ICaspar\Simple\Domain\Author\Author;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

final class AuthorTest extends TestCase
{
    /**
     * @test
     */
    public function shouldThrowWhenInvalidUuid(): void
    {
        $this->expectException(InvalidUuidStringException::class);
        $this->expectExceptionMessage('Invalid UUID string: not a valid uuid');

        new Author(
            'Caspar Green',
            'caspar@example.com',
            'About the author:',
            'not a valid Uuid'
        );
    }

    /**
     * @test
     */
    public function shouldAcceptUuidAsInstance(): void
    {
        $uuid = Uuid::uuid5(Author::AUTHOR_NAMESPACE, 'Caspar Green');

        $this->assertInstanceOf(
            Author::class,
            new Author(
                'Caspar Green',
                'caspar@example.com',
                'About the author:',
                $uuid
            )
        );
    }

    /**
     * @test
     */
    public function shouldAcceptUuidAsString(): void
    {
        $uuidString = Uuid::uuid5(Author::AUTHOR_NAMESPACE, 'test')
                          ->toString();

        $this->assertInstanceOf(
            Author::class,
            new Author(
                'Caspar Green',
                'caspar@example.com',
                'About the author:',
                $uuidString
            )
        );
    }
}
