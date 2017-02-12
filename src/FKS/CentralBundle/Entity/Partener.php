<?php

namespace FKS\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Partener
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="partener")
 * @ORM\Entity(repositoryClass="FKS\CentralBundle\Repository\PartenerRepository")
 */
class Partener
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
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\subPartener", mappedBy="partener")
     */
    private $subPartener;
    /**
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\Groups", inversedBy="partner")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", nullable=false)
     */
    protected $group;
    
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
     * @return Partener
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
     * @return Partener
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
     * @return Partener
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
    public function __toString()
    {
        return $this->getType();
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subPartener = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subPartener
     *
     * @param \FKS\CentralBundle\Entity\subPartener $subPartener
     *
     * @return Partener
     */
    public function addSubPartener(\FKS\CentralBundle\Entity\subPartener $subPartener)
    {
        $this->subPartener[] = $subPartener;

        return $this;
    }

    /**
     * Remove subPartener
     *
     * @param \FKS\CentralBundle\Entity\subPartener $subPartener
     */
    public function removeSubPartener(\FKS\CentralBundle\Entity\subPartener $subPartener)
    {
        $this->subPartener->removeElement($subPartener);
    }

    /**
     * Get subPartener
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubPartener()
    {
        return $this->subPartener;
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

    /**
     * Set group
     *
     * @param \FKS\CentralBundle\Entity\Groups $group
     *
     * @return Partener
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
}
