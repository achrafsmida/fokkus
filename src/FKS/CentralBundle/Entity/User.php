<?php

namespace FKS\CentralBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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

    /**
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\Message", mappedBy="sender")
     */
    private $message;

    /**
     * @ORM\ManyToMany(targetEntity="FKS\CentralBundle\Entity\Message", mappedBy="users")
     */
    private $messages;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add subNetwork
     *
     * @param \FKS\CentralBundle\Entity\subNetwork $subNetwork
     *
     * @return User
     */
    public function addSubNetwork(\FKS\CentralBundle\Entity\subNetwork $subNetwork)
    {
        $this->subNetwork[] = $subNetwork;

        return $this;
    }

    /**
     * Remove subNetwork
     *
     * @param \FKS\CentralBundle\Entity\subNetwork $subNetwork
     */
    public function removeSubNetwork(\FKS\CentralBundle\Entity\subNetwork $subNetwork)
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

   

    /**
     * Add message
     *
     * @param \FKS\CentralBundle\Entity\Message $message
     *
     * @return User
     */
    public function addMessage(\FKS\CentralBundle\Entity\Message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \FKS\CentralBundle\Entity\Message $message
     */
    public function removeMessage(\FKS\CentralBundle\Entity\Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Get message
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessage()
    {
        return $this->message;
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
        return 'uploads/users';
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
     * Set pictureName
     *
     * @param string $pictureName
     *
     * @return User
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
}
