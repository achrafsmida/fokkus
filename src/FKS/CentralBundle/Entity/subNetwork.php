<?php

namespace FKS\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Startup
 *
 * @ORM\Table(name="sub_network")
 * @ORM\Entity(repositoryClass="FKS\CentralBundle\Repository\StartupRepository")
 */
class subNetwork
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
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="society", type="string", length=255)
     */
    private $society;

    /**
     * @var string
     *
     * @ORM\Column(name="fix", type="string", length=255)
     */
    private $fix;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=255)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=255)
     */
    private $site;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\Network")
     * @ORM\JoinColumn(name="network_id", referencedColumnName="id", nullable=false)
     */
    protected $network;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Startup
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Startup
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Startup
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set society
     *
     * @param string $society
     *
     * @return Startup
     */
    public function setSociety($society)
    {
        $this->society = $society;

        return $this;
    }

    /**
     * Get society
     *
     * @return string
     */
    public function getSociety()
    {
        return $this->society;
    }

    /**
     * Set fix
     *
     * @param string $fix
     *
     * @return Startup
     */
    public function setFix($fix)
    {
        $this->fix = $fix;

        return $this;
    }

    /**
     * Get fix
     *
     * @return string
     */
    public function getFix()
    {
        return $this->fix;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     *
     * @return Startup
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return Startup
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set site
     *
     * @param string $site
     *
     * @return Startup
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Startup
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
     * Set user
     *
     * @param \FKS\CentralBundle\Entity\User $user
     *
     * @return SubNetwork
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
     * @return SubNetwork
     */
    public function addNetwork(\FKS\CentralBundle\Entity\Network $network)
    {
        $this->network[] = $network;

        return $this;
    }

   
    public function __toString()
    {
        return $this->getLastName();
    }

    /**
     * Set network
     *
     * @param \FKS\CentralBundle\Entity\Network $network
     *
     * @return subNetwork
     */
    public function setNetwork(\FKS\CentralBundle\Entity\Network $network)
    {
        $this->network = $network;

        return $this;
    }

    /**
     * Get network
     *
     * @return \FKS\CentralBundle\Entity\Network
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return subNetwork
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
     * @return subNetwork
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
}
