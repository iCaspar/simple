<?php

declare(strict_types=1);

namespace ICaspar\Simple\Core\Entities;

use DateTime;
use Exception;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\UuidInterface;

final class Article extends Entity
{
    public const ARTICLE_NAMESPACE = '8568ec24-bee6-435c-8bcb-8f946b88fffb';

    private readonly DateTime $date;

    /**
     * Instantiate an Article.
     *
     * @param string $title
     * @param string $authorId
     * @param string $content
     * @param string|UuidInterface $uuid
     * @param string|DateTime $date
     *
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
        $this->uuid = $this->sanitizeToUuid(
            $uuid,
            self::ARTICLE_NAMESPACE,
            $this->title . $this->authorId
        );
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
