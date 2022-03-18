<?php

namespace App\Classe;

class Message
{

    private string $id;
    private string $user1;
    private string $user2;
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
     * @return string
     */
    public function getUser1(): string
    {
        return $this->user1;
    }

    /**
     * @param string $user1
     * @return Message
     */
    public function setUser1(string $user1): self
    {
        $this->user1 = $user1;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser2(): string
    {
        return $this->user2;
    }

    /**
     * @param string $user2
     * @return Message
     */
    public function setUser2(string $user2): self
    {
        $this->user2 = $user2;
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