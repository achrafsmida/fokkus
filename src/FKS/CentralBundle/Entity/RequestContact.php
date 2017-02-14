<?php

namespace FKS\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RequestContact
 *
 * @ORM\Table(name="request_contact")
 * @ORM\Entity(repositoryClass="FKS\CentralBundle\Repository\RequestContactRepository")
 */
class RequestContact
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
     * @ORM\Column(name="createdDate", type="date")
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedDate", type="date")
     */
    private $updatedDate;

    /**
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\User", inversedBy="requestSender")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id", nullable=false)
     */
    protected $sender;

    /**
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\User", inversedBy="requestReceiver")
     * @ORM\JoinColumn(name="receiver_id", referencedColumnName="id", nullable=false)
     */
    protected $receiver;
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
     * @return RequestContact
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
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return RequestContact
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
     * @return RequestContact
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
     * Set sender
     *
     * @param \FKS\CentralBundle\Entity\User $sender
     *
     * @return RequestContact
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
     * Set receiver
     *
     * @param \FKS\CentralBundle\Entity\User $receiver
     *
     * @return RequestContact
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
}
