<?php

namespace FKS\CentralBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="FKS\CentralBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\subNetwork", mappedBy="user")
     */
    private $subNetwork;

    /**
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\Message", mappedBy="sender")
     */
    private $message;

    /**
     * @ORM\ManyToMany(targetEntity="FKS\CentralBundle\Entity\Message", mappedBy="users")
     */
    private $messages;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add subNetwork
     *
     * @param \FKS\CentralBundle\Entity\subNetwork $subNetwork
     *
     * @return User
     */
    public function addSubNetwork(\FKS\CentralBundle\Entity\subNetwork $subNetwork)
    {
        $this->subNetwork[] = $subNetwork;

        return $this;
    }

    /**
     * Remove subNetwork
     *
     * @param \FKS\CentralBundle\Entity\subNetwork $subNetwork
     */
    public function removeSubNetwork(\FKS\CentralBundle\Entity\subNetwork $subNetwork)
    {
        $this->subNetwork->removeElement($subNetwork);
    }

    /**
     * Get subNetwork
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubNetwork()
    {
        return $this->subNetwork;
    }

   

    /**
     * Add message
     *
     * @param \FKS\CentralBundle\Entity\Message $message
     *
     * @return User
     */
    public function addMessage(\FKS\CentralBundle\Entity\Message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \FKS\CentralBundle\Entity\Message $message
     */
    public function removeMessage(\FKS\CentralBundle\Entity\Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Get message
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessage()
    {
        return $this->message;
    }
}
