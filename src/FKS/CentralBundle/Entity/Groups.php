<?php

namespace FKS\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Groups
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="FKS\CentralBundle\Repository\GroupsRepository")
 */
class Groups
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

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
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\Network", mappedBy="group")
     */
    private $network;
    
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
     * @return Groups
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
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Groups
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
     * @return Groups
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
     * @return Groups
     */
    public function addNetwork(\FKS\CentralBundle\Entity\Network $network)
    {
        $this->network[] = $network;

        return $this;
    }

    /**
     * Remove network
     *
     * @param \FKS\CentralBundle\Entity\Network $network
     */
    public function removeNetwork(\FKS\CentralBundle\Entity\Network $network)
    {
        $this->network->removeElement($network);
    }

    /**
     * Get network
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNetwork()
    {
        return $this->network;
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
        return 'uploads/group';
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

}
