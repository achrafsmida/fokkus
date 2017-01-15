<?php

namespace FKS\CentralBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="FKS\CentralBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\subNetwork", mappedBy="user")
     */
    private $subNetwork;
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add subNetwork
     *
     * @param \PxCore\CentralBundle\Entity\subNetwork $subNetwork
     *
     * @return User
     */
    public function addSubNetwork(\PxCore\CentralBundle\Entity\subNetwork $subNetwork)
    {
        $this->subNetwork[] = $subNetwork;

        return $this;
    }

    /**
     * Remove subNetwork
     *
     * @param \PxCore\CentralBundle\Entity\subNetwork $subNetwork
     */
    public function removeSubNetwork(\PxCore\CentralBundle\Entity\subNetwork $subNetwork)
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
}
