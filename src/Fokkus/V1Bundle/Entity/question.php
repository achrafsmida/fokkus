<?php

namespace Fokkus\V1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * question
 *
 * @ORM\Table(name="question")
 *@ORM\HasLifecycleCallbacks()

 * @ORM\Entity(repositoryClass="Fokkus\V1Bundle\Repository\questionRepository")
 */
class question
{
    
    
      /**
   * @ORM\OneToMany(targetEntity="Fokkus\V1Bundle\Entity\response", mappedBy="response")
   */
  private $response; 
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
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;
    /**
     * @var string
     *
     * @ORM\Column(name="typeofquestions", type="integer")
     */
    private $typeofquestions;
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
     * Set question
     *
     * @param string $question
     *
     * @return question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return question
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
     * @return question
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
     * Set datastatus
     *
     * @param string $datastatus
     *
     * @return question
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
    $this->setDatastatus(1);
    $this->setDateupdated(new \Datetime());
  }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->response = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add response
     *
     * @param \Fokkus\V1Bundle\Entity\response $response
     *
     * @return question
     */
    public function addResponse(\Fokkus\V1Bundle\Entity\response $response)
    {
        $this->response[] = $response;

        return $this;
    }

    /**
     * Remove response
     *
     * @param \Fokkus\V1Bundle\Entity\response $response
     */
    public function removeResponse(\Fokkus\V1Bundle\Entity\response $response)
    {
        $this->response->removeElement($response);
    }

    /**
     * Get response
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set typeofquestions
     *
     * @param integer $typeofquestions
     *
     * @return question
     */
    public function setTypeofquestions($typeofquestions)
    {
        $this->typeofquestions = $typeofquestions;

        return $this;
    }

    /**
     * Get typeofquestions
     *
     * @return integer
     */
    public function getTypeofquestions()
    {
        return $this->typeofquestions;
    }
}
