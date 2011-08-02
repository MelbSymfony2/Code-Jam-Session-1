<?php
/*
 * 
 * User: camm
 */
 
namespace MelbSymfony2\ForumExampleBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 *
 * @author camm
 * @ORM\Entity
 * @ORM\Table(name="user");
 */
class User implements UserInterface
{
    const SALT = 'hardcoded-salt';
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", name="email_address")
     * @Assert\Email()
     */
    private $emailAddress;

    /**
     * @ORM\Column(type="string", name="password")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="Thread", mappedBy="user")
     */
    private $threads;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     */
    private $posts;

    /**
     * @Assert\NotBlank()
     */
    private $passwordNew;

    /**
     * @Assert\NotBlank()
     */
    private $passwordConfirm;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->threads = new \Doctrine\Common\Collections\ArrayCollection();
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setThreads($threads)
    {
        $this->threads = $threads;
    }

    public function getThreads()
    {
        return $this->threads;
    }

    /**
     * The equality comparison should neither be done by referential equality
     * nor by comparing identities (i.e. getId() === getId()).
     *
     * However, you do not need to compare every attribute, but only those that
     * are relevant for assessing whether re-authentication is required.
     *
     * @param UserInterface $user
     * @return Boolean
     */
    function equals(UserInterface $user)
    {
        return $user->getUsername() == $this->getUsername() && $user->getPassword() == $this->getPassword();
    }

    /**
     * Removes sensitive data from the user.
     *
     * @return void
     */
    function eraseCredentials()
    {
        $this->setPassword(null);
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    function getUsername()
    {
        return $this->getName();
    }

    /**
     * Returns the salt.
     *
     * @return string The salt
     */
    function getSalt()
    {
        return self::SALT;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * @return string The password
     */
    function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the roles granted to the user.
     *
     * @return Role[] The user roles
     */
    function getRoles()
    {
        return array('ROLE_USER');
    }

    public function setPasswordConfirm($passwordConfirm)
    {
        $this->passwordConfirm = $passwordConfirm;
    }

    public function getPasswordConfirm()
    {
        return $this->passwordConfirm;
    }

    public function setPasswordNew($passwordNew)
    {
        $this->passwordNew = $passwordNew;
    }

    public function getPasswordNew()
    {
        return $this->passwordNew;
    }

    /**
     * @Assert\True
     */
    public function isPasswordConfirmValid()
    {
        return $this->getPasswordNew() == $this->getPasswordConfirm();
    }
}
