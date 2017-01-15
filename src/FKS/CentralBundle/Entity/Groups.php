<?php

namespace FKS\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groups
 *
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="FKS\CentralBundle\Repository\GroupsRepository")
 */
class Groups
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

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
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\Network", mappedBy="group")
     */
    private $network;
    
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
     * Set name
     *
     * @param string $name
     *
     * @return Groups
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Groups
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
     * @return Groups
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
     * Constructor
     */
    public function __construct()
    {
        $this->network = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add network
     *
     * @param \FKS\CentralBundle\Entity\Network $network
     *
     * @return Groups
     */
    public function addNetwork(\FKS\CentralBundle\Entity\Network $network)
    {
        $this->network[] = $network;

        return $this;
    }

    /**
     * Remove network
     *
     * @param \FKS\CentralBundle\Entity\Network $network
     */
    public function removeNetwork(\FKS\CentralBundle\Entity\Network $network)
    {
        $this->network->removeElement($network);
    }

    /**
     * Get network
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNetwork()
    {
        return $this->network;
    }
    public function __toString()
    {
        return $this->getName();
    }
}
