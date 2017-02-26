<?php

namespace Fokkus\V1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * scores
 *
 * @ORM\Table(name="scores")
 * @ORM\Entity(repositoryClass="Fokkus\V1Bundle\Repository\scoresRepository")
 */
class scores
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
     * @ORM\Column(name="type", type="integer")
     */
       private $type;
    
    /**
     * @var int
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;
    
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
     * Set score
     *
     * @param integer $score
     *
     * @return scores
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set user
     *
     * @param \FKS\CentralBundle\Entity\User $user
     *
     * @return scores
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
     * @return scores
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
