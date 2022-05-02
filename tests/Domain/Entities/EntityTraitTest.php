<?php

declare(strict_types=1);

namespace ICaspar\Simple\Tests\Domain\Entities;

use ICaspar\Simple\Domain\Entities\NullEntity;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

/**
 * @covers \ICaspar\Simple\Domain\Entities\Entity
 * @covers \ICaspar\Simple\Domain\Entities\NullEntity
 */
final class EntityTraitTest extends TestCase
{
    /**
     * @test
     */
    public function shouldThrowWhenInvalidUuid(): void
    {
        $this->expectException(InvalidUuidStringException::class);
        $this->expectExceptionMessage('Invalid UUID string: not a valid uuid');

        new NullEntity('not a valid Uuid', Uuid::NIL, 'test');
    }

    /**
     * @test
     */
    public function shouldAcceptUuidAsInstance(): void
    {
        $uuid = Uuid::uuid5(Uuid::NIL, 'test');

        $this->assertInstanceOf(
            NullEntity::class,
            new NullEntity($uuid, Uuid::NIL, 'test')
        );
    }

    /**
     * @test
     */
    public function shouldAcceptUuidAsString(): void
    {
        $uuidString = Uuid::uuid5(Uuid::NIL, 'test')
                          ->toString();

        $this->assertInstanceOf(
            NullEntity::class,
            new NullEntity($uuidString, Uuid::NIL, 'test')
        );
    }

    /**
     * @test
     */
    public function shouldIdentifyMatchingUuid(): void
    {
        $namespace = Uuid::uuid4()->toString();
        $entityA = new NullEntity(
            '',
            $namespace,
            'test1'
        );

        $entityB = new NullEntity(
            '',
            $namespace,
            'test2'
        );

        $this->assertTrue(
            $entityA->isSame($entityA),
            'isSame() did not match an identical Entity.'
        );
        $this->assertFalse(
            $entityA->isSame($entityB),
            'isSame() did not identify a different Entity.'
        );
    }
}
