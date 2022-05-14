<?php

declare(strict_types=1);

namespace ICaspar\Simple\Tests\Core\Author;

use ICaspar\Simple\Core\Author\Author;
use ICaspar\Simple\Core\Author\AuthorManager;
use ICaspar\Simple\Core\Ports\Secondary\AuthorRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * @covers \ICaspar\Simple\Core\Author\AuthorManager
 */
final class AuthorManagerTest extends TestCase
{
    private AuthorManager $manager;

    public function setUp(): void
    {
        $repository = Mockery::mock(AuthorRepository::class);
        $repository->allows('save');

        /** @var AuthorRepository $repository */
        $this->manager = new AuthorManager($repository);
    }

    /**
     * @test
     * @uses \ICaspar\Simple\Core\Author\Author
     * @uses \ICaspar\Simple\Core\Entities\EntityTrait::sanitizeToUuid()
     */
    public function shouldCreateAnAuthor(): void
    {
        $author = $this->manager->create('Caspar Green', 'caspar@example.com', 'About me.');

        $this->assertInstanceOf(Author::class, $author);
    }
}
