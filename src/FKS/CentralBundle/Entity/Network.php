<?php

namespace FKS\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Network
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="network")
 * @ORM\Entity(repositoryClass="FKS\CentralBundle\Repository\NetworkRepository")
 */
class Network
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="have_user", type="boolean")
     */
    private $haveUser;

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
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\Groups")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", nullable=false)
     */
    protected $group;

    /**
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\subNetwork", mappedBy="network")
     */
    private $subNetwork;

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
     * Set type
     *
     * @param string $type
     *
     * @return Network
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Network
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
     * @return Network
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
     * Set group
     *
     * @param \FKS\CentralBundle\Entity\Groups $group
     *
     * @return Network
     */
    public function setGroup(\FKS\CentralBundle\Entity\Groups $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \FKS\CentralBundle\Entity\Groups
     */
    public function getGroup()
    {
        return $this->group;
    }
    
    /**
     * Set haveUser
     *
     * @param boolean $haveUser
     *
     * @return Network
     */
    public function setHaveUser($haveUser)
    {
        $this->haveUser = $haveUser;

        return $this;
    }

    /**
     * Get haveUser
     *
     * @return boolean
     */
    public function getHaveUser()
    {
        return $this->haveUser;
    }
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subNetwork = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subNetwork
     *
     * @param \FKS\CentralBundle\Entity\subNetwork $subNetwork
     *
     * @return Network
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

    public function __toString()
    {
        return $this->getType();
    }
    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->setUpdatedDate(new \Datetime());
    }

    /**
     * @ORM\PrePersist
     */

    public function addDate()
    {
        $this->setCreatedDate(new \Datetime());
        $this->setUpdatedDate(new \Datetime());
    }
}
