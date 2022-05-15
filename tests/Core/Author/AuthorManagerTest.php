<?php

declare(strict_types=1);

namespace ICaspar\Simple\Tests\Core\Author;

use ICaspar\Simple\Core\Author\Author;
use ICaspar\Simple\Core\Author\AuthorManager;
use ICaspar\Simple\Tests\Stubs\Core\Author\AuthorRepositoryStub;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Rfc4122\UuidV5;
use Ramsey\Uuid\Uuid;

/**
 * @covers \ICaspar\Simple\Core\Author\AuthorManager
 */
final class AuthorManagerTest extends TestCase
{
    private AuthorManager $manager;

    public function setUp(): void
    {
        $this->manager = new AuthorManager(new AuthorRepositoryStub());
    }

    /**
     * @test
     * @uses \ICaspar\Simple\Core\Author\Author
     * @uses \ICaspar\Simple\Core\Entities\EntityTrait::sanitizeToUuid()
     */
    public function shouldReturnTheCreatedAuthor(): void
    {
        $uuid = Uuid::uuid5(Author::NAMESPACE, 'Caspar Greencaspar@example.com')->toString();
        $author = $this->manager->create('Caspar Green', 'caspar@example.com', 'About me.');

        $this->assertSame($uuid, $author->uuid());
    }
}
