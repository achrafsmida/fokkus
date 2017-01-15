<?php

namespace Fokkus\V1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * step
 *
 * @ORM\Table(name="step")
 * @ORM\Entity(repositoryClass="Fokkus\V1Bundle\Repository\stepRepository")
 * @ORM\HasLifecycleCallbacks()

 */
class step
{
    
    /**
   * @ORM\OneToMany(targetEntity="Fokkus\V1Bundle\Entity\sousstep", mappedBy="sousstep")
   */
  private $sousstep; 
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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime")
     */
    private $datecreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateupdated", type="datetime")
     */
    private $dateupdated;


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
     * @return step
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
     * Set description
     *
     * @param string $description
     *
     * @return step
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return step
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    /**
     * Get datecreated
     *
     * @return \DateTime
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

    /**
     * Set dateupdated
     *
     * @param \DateTime $dateupdated
     *
     * @return step
     */
    public function setDateupdated($dateupdated)
    {
        $this->dateupdated = $dateupdated;

        return $this;
    }

    /**
     * Get dateupdated
     *
     * @return \DateTime
     */
    public function getDateupdated()
    {
        return $this->dateupdated;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sousstep = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sousstep
     *
     * @param \Fokkus\V1Bundle\Entity\sousstep $sousstep
     *
     * @return step
     */
    public function addSousstep(\Fokkus\V1Bundle\Entity\sousstep $sousstep)
    {
        $this->sousstep[] = $sousstep;

        return $this;
    }

    /**
     * Remove sousstep
     *
     * @param \Fokkus\V1Bundle\Entity\sousstep $sousstep
     */
    public function removeSousstep(\Fokkus\V1Bundle\Entity\sousstep $sousstep)
    {
        $this->sousstep->removeElement($sousstep);
    }

    /**
     * Get sousstep
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousstep()
    {
        return $this->sousstep;
    }
     public function __toString()
    {
        return $this->getName();
    }
   /**
 * @ORM\PreUpdate
 */ 
 public function updateDate()
  {
        $this->setDateupdated(new \Datetime());
  }
 
    /**
 * @ORM\PrePersist
 */ 
  
   public function addDate()
  {
    $this->setDatecreated(new \Datetime());
    $this->setDateupdated(new \Datetime());
  }
  
  
  

    /**
     * Set type
     *
     * @param string $type
     *
     * @return step
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
}
