<?php

namespace FKS\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="FKS\CentralBundle\Repository\MessageRepository")
 */
class Message
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\User")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id", nullable=false)
     */
    protected $sender;
    
    /**
     * @var string
     *
     * @ORM\Column(name="readed", type="boolean")
     */
    private $readed;

    /**
     * @var string
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @ORM\ManyToMany(targetEntity="FKS\CentralBundle\Entity\User", inversedBy="messages")
     * @ORM\JoinTable(name="users_messages",
     *     joinColumns={@ORM\JoinColumn(name="message_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    private $users;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetime")
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedDate", type="datetime")
     */
    private $updatedDate;
    
  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Message
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set read
     *
     * @param boolean $read
     *
     * @return Message
     */
    public function setReaded($readed)
    {
        $this->readed = $readed;

        return $this;
    }

    /**
     * Get read
     *
     * @return boolean
     */
    public function getReaded()
    {
        return $this->readed;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Message
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     *
     * @return Message
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * Add user
     *
     * @param \FKS\CentralBundle\Entity\User $user
     *
     * @return Message
     */
    public function addUser(\FKS\CentralBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \FKS\CentralBundle\Entity\User $user
     */
    public function removeUser(\FKS\CentralBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set sender
     *
     * @param \FKS\CentralBundle\Entity\User $sender
     *
     * @return Message
     */
    public function setSender(\FKS\CentralBundle\Entity\User $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \FKS\CentralBundle\Entity\User
     */
    public function getSender()
    {
        return $this->sender;
    }
    /**
     * @ORM\PreUpdate
     */
    public function updatedDate()
    {
        $this->setUpdatedDate(new \Datetime());
    }

    /**
     * @ORM\PrePersist
     */

    public function addDate()
    {
        $this->setUpdatedDate(new \Datetime());
        $this->setCreatedDate(new \Datetime());
    }


    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Message
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}
