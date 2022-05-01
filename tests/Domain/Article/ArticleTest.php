<?php

declare(strict_types=1);

namespace ICaspar\Simple\Tests\Domain\Article;

use DateTime;
use Exception;
use ICaspar\Simple\Domain\Article\Article;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

/**
 * @covers \ICaspar\Simple\Domain\Article\Article
 */
final class ArticleTest extends TestCase
{
    private Article $article;

    public function setUp(): void
    {
        $uuid          = Uuid::uuid5(Article::ARTICLE_NAMESPACE, 'test');
        $this->article = new Article(
            'Article Title',
            '11',
            'Some content.',
            $uuid,
            'January 1, 2022 11:02am'
        );
    }

    /**
     * @test
     */
    public function shouldThrowWhenInvalidUuid(): void
    {
        $this->expectException(InvalidUuidStringException::class);
        $this->expectExceptionMessage('Invalid UUID string: not a valid uuid');

        new Article(
            'Title',
            '1',
            'Content',
            'not a valid Uuid'
        );
    }

    /**
     * @test
     */
    public function shouldAcceptUuidAsInstance(): void
    {
        $uuid = Uuid::uuid5(Article::ARTICLE_NAMESPACE, 'test');

        $this->assertInstanceOf(
            Article::class,
            new Article('Title', '1', 'Content', $uuid)
        );
    }

    /**
     * @test
     */
    public function shouldAcceptUuidAsString(): void
    {
        $uuidString = Uuid::uuid5(Article::ARTICLE_NAMESPACE, 'test')
                          ->toString();

        $this->assertInstanceOf(
            Article::class,
            new Article('Title', '1', 'Content', $uuidString)
        );
    }

    /**
     * @test
     */
    public function shouldIdentifyMatchingUuid(): void
    {
        $differentArticle = new Article(
            'Article Title',
            '11',
            'Some content.',
            Uuid::uuid4()
        );

        $this->assertFalse(
            $this->article->isSame($differentArticle),
            'isSame() did not identify a different Article.'
        );
        $this->assertTrue(
            $this->article->isSame($this->article),
            'isSame() did not match an identical Article.'
        );
    }

    /**
     * @test
     * @depends shouldIdentifyMatchingUuid
     */
    public function shouldGenerateNewUuidFromTitleAndAuthorWhenNoneGiven(): void
    {
        $expectedArticle = new Article(
            'Title',
            '1',
            'Content',
            Uuid::uuid5(
                Article::ARTICLE_NAMESPACE,
                'Title1'
            )
        );

        $article = new Article('Title', '1', 'Content');

        $this->assertTrue($expectedArticle->isSame($article));
    }

    /**
     * @test
     */
    public function shouldThrowWhenInvalidDate(): void
    {
        $this->expectException(Exception::class);

        new Article(
            'Title',
            '1',
            'Content',
            '',
            'not a valid date'
        );
    }

    /**
     * @test
     */
    public function shouldAcceptDateAsInstance(): void
    {
        $this->assertInstanceOf(
            Article::class,
            new Article(
                'Title',
                '1',
                'Content',
                '',
                new DateTime()
            )
        );
    }

    /**
     * @test
     */
    public function shouldAcceptDateAsString(): void
    {
        $this->assertInstanceOf(
            Article::class,
            new Article(
                'Title',
                '1',
                'Content',
                '',
                'May 1, 2022 10:45am'
            )
        );
    }

    /**
     * @test
     */
    public function shouldReturnItsTitle(): void
    {
        $this->assertSame('Article Title', $this->article->title());
    }

    /**
     * @test
     */
    public function shouldReturnItsAuthorsId(): void
    {
        $this->assertSame('11', $this->article->author());
    }

    /**
     * @test
     */
    public function shouldReturnItsContent(): void
    {
        $this->assertSame('Some content.', $this->article->content());
    }

    /**
     * @test
     */
    public function shouldReturnItsDate(): void
    {
        $this->assertSame(
            '2022-01-01T11:02:00+00:00',
            $this->article->date()->format(DATE_ATOM)
        );
    }

    /**
     * @test
     * @depends shouldReturnItsDate
     */
    public function shouldUseCurrentDateTimeWhenNotGiven(): void
    {
        $article = new Article(
            'Title',
            '1',
            'Content',
            '',
            ''
        );

        $this->assertLessThan(
            3,
            (new DateTime())->getTimestamp() - $article->date()->getTimestamp()
        );
    }
}