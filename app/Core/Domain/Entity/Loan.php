<?php

namespace App\Core\Domain\Entity;

class Loan
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $book_id;

    /**
     * @var string
     */
    private $user_id;

    /**
     * Book constructor.
     *
     * @param string $id
     * @param string $book_id
     * @param string $user_id
     */
    public function __construct(string $id, string $book_id, string $user_id)
    {
        $this->id = $id;
        $this->book_id = $book_id;
        $this->user_id = $user_id;
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
    public function getBookId(): string
    {
        return $this->book_id;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->user_id;
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'book_id' => $this->getBookId(),
            'user_id' => $this->getUserId(),
        ];
    }
}