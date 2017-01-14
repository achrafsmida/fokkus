<?php

namespace Fokkus\V1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * sousstep
 *
 * @ORM\Table(name="sousstep")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Fokkus\V1Bundle\Repository\sousstepRepository")
 */
class sousstep
{
    
    
      /**
   * @ORM\ManyToOne(targetEntity="Fokkus\V1Bundle\Entity\step")
   * @ORM\JoinColumn(nullable=false)
   */
  private $step;
    
    
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
     * @var text
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
     * @return sousstep
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
     * @return sousstep
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
     * @return sousstep
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
     * @param string $dateupdated
     *
     * @return sousstep
     */
    public function setDateupdated($dateupdated)
    {
        $this->dateupdated = $dateupdated;

        return $this;
    }

    /**
     * Get dateupdated
     *
     * @return string
     */
    public function getDateupdated()
    {
        return $this->dateupdated;
    }

    /**
     * Set step
     *
     * @param \Fokkus\V1Bundle\Entity\step $step
     *
     * @return sousstep
     */
    public function setStep(\Fokkus\V1Bundle\Entity\step $step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return \Fokkus\V1Bundle\Entity\step
     */
    public function getStep()
    {
        return $this->step;
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
}
