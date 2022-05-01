<?php

declare(strict_types=1);

namespace ICaspar\Simple\Domain\Article;

use DateTime;
use Exception;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

final class Article
{
    public const ARTICLE_NAMESPACE = '8568ec24-bee6-435c-8bcb-8f946b88fffb';

    private readonly UuidInterface $uuid;
    private readonly DateTime $date;

    /**
     * @throws Exception
     * @throws InvalidUuidStringException
     */
    public function __construct(
        private readonly string $title,
        private readonly string $authorId,
        private readonly string $content,
        string|UuidInterface $uuid = '',
        string|DateTime $date = ''
    ) {
        $this->uuid = $this->sanitizeToUuid($uuid);
        $this->date = $this->sanitizeToDateTime($date);
    }

    /**
     * Return the title.
     *
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * Return the author.
     *
     * @return string
     */
    public function author(): string
    {
        return $this->authorId;
    }

    /**
     * Return the content.
     *
     * @return string
     */
    public function content(): string
    {
        return $this->content;
    }

    /**
     * Return the date.
     *
     * @return DateTime
     */
    public function date(): DateTime
    {
        return $this->date;
    }

    public function isSame(Article $article): bool
    {
        return $this->uuid->equals($article->uuid);
    }

    /**
     * Sanitize to a Uuid instance.
     *
     * @param UuidInterface|string $uuid
     *
     * @return UuidInterface
     *
     * @throws InvalidUuidStringException
     */
    private function sanitizeToUuid(UuidInterface|string $uuid): UuidInterface
    {
        $uuid = empty($uuid)
            ? Uuid::uuid5(self::ARTICLE_NAMESPACE, $this->title . $this->authorId)
            : $uuid;

        return $uuid instanceof UuidInterface
            ? $uuid
            : Uuid::fromString($uuid);
    }

    /**
     * Sanitize to a DateTime instance.
     *
     * @param DateTime|string $date
     *
     * @return DateTime
     *
     * @throws Exception
     */
    private function sanitizeToDateTime(DateTime|string $date): DateTime
    {
        return $date instanceof DateTime
            ? $date
            : new DateTime($date);
    }
}
