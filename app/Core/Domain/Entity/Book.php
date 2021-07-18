<?php

namespace App\Core\Domain\Entity;

class Book
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    /**
     * Book constructor.
     *
     * @param string $id
     * @param string $title
     * @param string $author
     */
    public function __construct(string $id, string $title, string $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'author' => $this->getAuthor(),
        ];
    }
}