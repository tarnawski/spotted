<?php

namespace SpottedBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Wall
{
    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var ArrayCollection | Post[] */
    private $posts;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param Post $post
     */
    public function addAttribute(Post $post)
    {
        if (!$this->posts->contains($post)) {
            $post->setWall($this);
            $this->posts[] = $post;
        }
    }

    /**
     * @param Post $post
     */
    public function removeAttribute(Post $post)
    {
        $this->posts->removeElement($post);
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