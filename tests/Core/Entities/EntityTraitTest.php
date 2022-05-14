<?php

declare(strict_types=1);

namespace ICaspar\Simple\Tests\Core\Entities;

use ICaspar\Simple\Core\Entities\NullEntity;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

/**
 * @covers \ICaspar\Simple\Core\Entities\Entity
 * @covers \ICaspar\Simple\Core\Entities\NullEntity
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

        new NullEntity('', 'Not a valid uuid');
    }

    /**
     * @test
     */
    public function shouldAcceptUuidAsInstance(): void
    {
        $uuid = Uuid::uuid5(Uuid::NIL, 'test');

        $this->assertInstanceOf(
            NullEntity::class,
            new NullEntity('', $uuid)
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
            new NullEntity('', $uuidString)
        );
    }

    /**
     * @test
     * @depends shouldIdentifyMatchingUuid
     * @depends shouldAcceptUuidAsString
     */
    public function shouldGenerateNewUuidFromKeyWhenNoUuidGiven(): void
    {
        $expectedEntity = new NullEntity('');

        $this->assertTrue($expectedEntity->isSame($expectedEntity));
    }

    /**
     * @test
     * @depends shouldAcceptUuidAsInstance
     */
    public function shouldReturnItsUuidAsString(): void
    {
        $uuid = Uuid::uuid5(Uuid::NIL, 'test');

        $entity = new NullEntity('', $uuid);

        $this->assertSame($uuid->toString(), $entity->id());
    }

    /**
     * @test
     * @depends shouldAcceptUuidAsString
     */
    public function shouldIdentifyMatchingUuid(): void
    {
        $entityA = new NullEntity('test1');
        $entityB = new NullEntity('test2');

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
