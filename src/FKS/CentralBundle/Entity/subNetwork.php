<?php

namespace FKS\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Startup
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

//    /**
//     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\User", inversedBy="subNetwork")
//     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
//     */
//    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\Network", inversedBy="subNetwork")
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
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\Statistique", mappedBy="sub")
     */
    private $stats;
    

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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $pictureName;

    /**
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     mimeTypesMessage = "The selected file does not match a valid image",
     *     uploadErrorMessage = "Error in uploading file"
     * )
     */
    public $file;

    public function getWebPath()
    {
        return null === $this->pictureName ? null : $this->getUploadDir().'/'.$this->pictureName;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/network';
    }

    public function uploadProfilePicture()
    {
        // Nous utilisons le nom de fichier original, donc il est dans la pratique
        // nécessaire de le nettoyer pour éviter les problèmes de sécurité

        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        // On sauvegarde le nom de fichier
        $this->pictureName = $this->file->getClientOriginalName();

        // La propriété file ne servira plus
        $this->file = null;
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
     * Set pictureName
     *
     * @param string $pictureName
     *
     * @return subNetwork
     */
    public function setPictureName($pictureName)
    {
        $this->pictureName = $pictureName;

        return $this;
    }

    /**
     * Get pictureName
     *
     * @return string
     */
    public function getPictureName()
    {
        return $this->pictureName;
    }

    /**
     * Add stat
     *
     * @param \FKS\CentralBundle\Entity\Statistique $stat
     *
     * @return subNetwork
     */
    public function addStat(\FKS\CentralBundle\Entity\Statistique $stat)
    {
        $this->stats[] = $stat;

        return $this;
    }

    /**
     * Remove stat
     *
     * @param \FKS\CentralBundle\Entity\Statistique $stat
     */
    public function removeStat(\FKS\CentralBundle\Entity\Statistique $stat)
    {
        $this->stats->removeElement($stat);
    }

    /**
     * Get stats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStats()
    {
        return $this->stats;
    }
}
