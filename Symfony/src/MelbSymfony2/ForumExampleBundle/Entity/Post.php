<?php
/*
 * 
 * Post: camm
 */
 
namespace MelbSymfony2\ForumExampleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author camm
 * @ORM\Entity
 * @ORM\Table(name="post");
 */
class Post 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column
     */
    private $title;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text", name="body")
     */
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Thread", inversedBy="posts")
     */
    private $thread;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setThread($thread)
    {
        $this->thread = $thread;
    }

    public function getThread()
    {
        return $this->thread;
    }


}
