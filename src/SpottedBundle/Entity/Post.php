<?php

namespace SpottedBundle\Entity;

class Post
{
    /** @var integer */
    private $id;

    /** @var string */
    private $content;

    /** @var Wall */
    private $wall;

    /** @var \DateTime */
    private $createdAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return Wall
     */
    public function getWall()
    {
        return $this->wall;
    }

    /**
     * @param Wall $wall
     */
    public function setWall($wall)
    {
        $this->wall = $wall;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}