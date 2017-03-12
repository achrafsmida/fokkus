<?php

namespace Fokkus\V1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * timeline
 *
 * @ORM\Table(name="timeline")
 * @ORM\Entity(repositoryClass="Fokkus\V1Bundle\Repository\timelineRepository")
 */
class timeline
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
   * @ORM\ManyToOne(targetEntity="Fokkus\V1Bundle\Entity\step")
   * @ORM\JoinColumn(nullable=false)
   */
  private $step;
  
        /**
   * @ORM\ManyToOne(targetEntity="Fokkus\V1Bundle\Entity\sousstep")
   * @ORM\JoinColumn(nullable=false)
   */
  private $sousstep;
  
     /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;
   /**
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
  
  
  
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
     * Set step
     *
     * @param \Fokkus\V1Bundle\Entity\step $step
     *
     * @return timeline
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
     * Set sousstep
     *
     * @param \Fokkus\V1Bundle\Entity\sousstep $sousstep
     *
     * @return timeline
     */
    public function setSousstep(\Fokkus\V1Bundle\Entity\sousstep $sousstep)
    {
        $this->sousstep = $sousstep;

        return $this;
    }

    /**
     * Get sousstep
     *
     * @return \Fokkus\V1Bundle\Entity\sousstep
     */
    public function getSousstep()
    {
        return $this->sousstep;
    }

    /**
     * Set user
     *
     * @param \FKS\CentralBundle\Entity\User $user
     *
     * @return timeline
     */
    public function setUser(\FKS\CentralBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \FKS\CentralBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return timeline
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }
}
