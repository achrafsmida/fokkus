<?php

namespace Fokkus\V1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * response
 *
 * @ORM\Table(name="response")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Fokkus\V1Bundle\Repository\responseRepository")
 */
class response
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
   * @ORM\ManyToOne(targetEntity="Fokkus\V1Bundle\Entity\question")
   * @ORM\JoinColumn(nullable=false)
   */
  private $question;
    /**
     * @var string
     *
     * @ORM\Column(name="response", type="string", length=255)
     */
    private $response;

    /**
     * @var string
     *
     * @ORM\Column(name="points", type="string", length=255)
     */
    private $points;

    
  
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datacreated", type="datetime")
     */
    private $datacreated;

    /** 
     * @var \DateTime
     *
     * @ORM\Column(name="dataupdated", type="datetime")
     */
    private $dataupdated;

    /**
     * @var string
     *
     * @ORM\Column(name="datastatus", type="string", length=255)
     */
    private $datastatus;


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
     * Set response
     *
     * @param string $response
     *
     * @return response
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set points
     *
     * @param string $points
     *
     * @return response
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return string
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set datacreated
     *
     * @param \DateTime $datacreated
     *
     * @return response
     */
    public function setDatacreated($datacreated)
    {
        $this->datacreated = $datacreated;

        return $this;
    }

    /**
     * Get datacreated
     *
     * @return \DateTime
     */
    public function getDatacreated()
    {
        return $this->datacreated;
    }

    /**
     * Set datastatus
     *
     * @param string $datastatus
     *
     * @return response
     */
    public function setDatastatus($datastatus)
    {
        $this->datastatus = $datastatus;

        return $this;
    }

    /**
     * Get datastatus
     *
     * @return string
     */
    public function getDatastatus()
    {
        return $this->datastatus;
    }

    /**
     * Set dataupdated
     *
     * @param \DateTime $dataupdated
     *
     * @return response
     */
    public function setDataupdated($dataupdated)
    {
        $this->dataupdated = $dataupdated;

        return $this;
    }

    /**
     * Get dataupdated
     *
     * @return \DateTime
     */
    public function getDataupdated()
    {
        return $this->dataupdated;
    }

    /**
     * Set question
     *
     * @param \Fokkus\V1Bundle\Entity\question $question
     *
     * @return response
     */
    public function setQuestion(\Fokkus\V1Bundle\Entity\question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Fokkus\V1Bundle\Entity\question
     */
    public function getQuestion()
    {
        return $this->question;
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
    $this->setDatacreated(new \Datetime());
    $this->setDatastatus(1);
    $this->setDataupdated(new \Datetime());
  }

   
}
