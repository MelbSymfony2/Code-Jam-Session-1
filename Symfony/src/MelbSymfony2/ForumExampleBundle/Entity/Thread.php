<?php
/*
 * 
 * Thread: camm
 */
 
namespace MelbSymfony2\ForumExampleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author camm
 * @ORM\Entity
 * @ORM\Table(name="thread");
 */
class Thread 
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
     * 
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="thread")
     */
    public $posts;


    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

}
