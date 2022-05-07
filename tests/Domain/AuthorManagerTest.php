<?php

declare(strict_types=1);

namespace ICaspar\Simple\Tests\Domain;

use ICaspar\Simple\Domain\AuthorManager;
use ICaspar\Simple\Domain\Entities\Author;
use ICaspar\Simple\Domain\Ports\Secondary\AuthorRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * @covers AuthorManager
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
     */
    public function shouldCreateAnAuthor(): void
    {
        $author = $this->manager->create('Caspar Green', 'caspar@example.com', 'About me.');

        $this->assertInstanceOf(Author::class, $author);
    }
}
