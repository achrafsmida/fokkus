<?php

namespace FKS\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Network
 *
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
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\subNetwork")
     * @ORM\JoinColumn(name="sub_id", referencedColumnName="id", nullable=false)
     */
    protected $sub;

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
     * Set sub
     *
     * @param \FKS\CentralBundle\Entity\subNetwork $sub
     *
     * @return Network
     */
    public function setSub(\FKS\CentralBundle\Entity\subNetwork $sub)
    {
        $this->sub = $sub;

        return $this;
    }

    /**
     * Get sub
     *
     * @return \FKS\CentralBundle\Entity\subNetwork
     */
    public function getSub()
    {
        return $this->sub;
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
   
}
