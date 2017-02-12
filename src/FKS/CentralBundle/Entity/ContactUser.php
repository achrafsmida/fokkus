<?php

namespace FKS\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ContactUser
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="contact_user")
 * @ORM\Entity(repositoryClass="FKS\CentralBundle\Repository\ContactUserRepository")
 */
class ContactUser
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
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\User", inversedBy="contact")
     * @ORM\JoinColumn(name="receiver_id", referencedColumnName="id", nullable=false)
     */
    protected $receiver;

    /**
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\User", inversedBy="contactSender")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id", nullable=false)
     */
    protected $sender;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return ContactUser
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ContactUser
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set receiver
     *
     * @param \FKS\CentralBundle\Entity\User $receiver
     *
     * @return ContactUser
     */
    public function setReceiver(\FKS\CentralBundle\Entity\User $receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return \FKS\CentralBundle\Entity\User
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set sender
     *
     * @param \FKS\CentralBundle\Entity\User $sender
     *
     * @return ContactUser
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
     * @ORM\PrePersist
     */
    public function addDate()
    {
        $this->setCreatedAt(new \Datetime());
    }
}
