<?php

namespace App\Classe;

use DateTime;

class Message
{

    private string $id;
    private User $user;
    private DateTime $dateSent;
    private string $content;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Message
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Message
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateSent(): DateTime
    {
        return $this->dateSent;
    }

    /**
     * @param DateTime $dateSent
     * @return Message
     */
    public function setDateSent(DateTime $dateSent): self
    {
        $this->dateSent = $dateSent;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Message
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

}