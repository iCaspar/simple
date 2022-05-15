<?php

declare(strict_types=1);

namespace ICaspar\Simple\Tests\Core\Author;

use ICaspar\Simple\Core\Author\Author;
use ICaspar\Simple\Core\Author\AuthorManager;
use ICaspar\Simple\Core\Ports\Repositories\AuthorRepository;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @covers \ICaspar\Simple\Core\Author\AuthorManager
 */
final class AuthorManagerTest extends TestCase
{
    private AuthorRepository $repository;
    private AuthorManager $manager;

    public function setUp(): void
    {
        $this->repository       = Mockery::mock(AuthorRepository::class);
        $this->manager    = new AuthorManager($this->repository);
    }

    /**
     * @test
     * @uses \ICaspar\Simple\Core\Author\Author
     * @uses \ICaspar\Simple\Core\Entities\EntityTrait::sanitizeToUuid()
     */
    public function shouldReturnTheCreatedAuthor(): void
    {
        $uuid = Uuid::uuid5(Author::NAMESPACE, 'Caspar Greencaspar@example.com')->toString();

        $this->repository->allows('save');

        $author = $this->manager->create('Caspar Green', 'caspar@example.com', 'About me.');

        $this->assertSame($uuid, $author->uuid());
    }

    /**
     * @test
     * @uses \ICaspar\Simple\Core\Author\Author
     * @uses \ICaspar\Simple\Core\Entities\EntityTrait::sanitizeToUuid()
     */
    public function shouldReturnAuthorsByNameWhenTheyExist(): void
    {
        $author1 = new Author('Caspar Green', 'caspar@example.com', '');
        $author2 = new Author('Caspar Green', 'cgreen@example.com', '');

        $this->repository->allows('getByName')
                         ->andReturns([$author1, $author2]);

        $authors = $this->manager->getByName('Caspar Green');

        $this->assertSame([$author1, $author2], $authors);
    }
}
