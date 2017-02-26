<?php

namespace FKS\CentralBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 * @ORM\Entity
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="email",
 *          column=@ORM\Column(
 *              name     = "email",
 *              type     = "string",
 *              length   = 255,
 *              nullable = true
 *          )
 *      ),
 *      @ORM\AttributeOverride(name="emailCanonical",
 *          column=@ORM\Column(
 *              name     = "emailCanonical",
 *              type     = "string",
 *              length   = 255,
 *              nullable = true
 *          )
 *      ),
 * })
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
//    /**
//     * @var string
//     *
//     * @ORM\Column(name="email", type="string", length=255, nullable=true)
//     */
//    protected $email;
    
//    /**
//     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\subNetwork", mappedBy="user")
//     */
//    private $subNetwork;

    /**
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\Message", mappedBy="sender")
     */
    private $message;

    /**
     * @ORM\ManyToMany(targetEntity="FKS\CentralBundle\Entity\Message", mappedBy="users")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\RequestContact", mappedBy="sender")
     */
    private $requestSender;

    /**
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\ContactUser", mappedBy="sender")
     */
    private $contactSender;

    /**
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\ContactUser", mappedBy="receiver")
     */
    private $contact;

    /**
     * @ORM\OneToMany(targetEntity="FKS\CentralBundle\Entity\RequestContact", mappedBy="receiver")
     */
    private $requestReceiver;

    /**
     * @ORM\ManyToOne(targetEntity="FKS\CentralBundle\Entity\Groups", inversedBy="user")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", nullable=true)
     */
    protected $group;
    
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

    /**
     * Add requestSender
     *
     * @param \FKS\CentralBundle\Entity\RequestContact $requestSender
     *
     * @return User
     */
    public function addRequestSender(\FKS\CentralBundle\Entity\RequestContact $requestSender)
    {
        $this->requestSender[] = $requestSender;

        return $this;
    }

    /**
     * Remove requestSender
     *
     * @param \FKS\CentralBundle\Entity\RequestContact $requestSender
     */
    public function removeRequestSender(\FKS\CentralBundle\Entity\RequestContact $requestSender)
    {
        $this->requestSender->removeElement($requestSender);
    }

    /**
     * Get requestSender
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRequestSender()
    {
        return $this->requestSender;
    }

    /**
     * Add requestReceiver
     *
     * @param \FKS\CentralBundle\Entity\RequestContact $requestReceiver
     *
     * @return User
     */
    public function addRequestReceiver(\FKS\CentralBundle\Entity\RequestContact $requestReceiver)
    {
        $this->requestReceiver[] = $requestReceiver;

        return $this;
    }

    /**
     * Remove requestReceiver
     *
     * @param \FKS\CentralBundle\Entity\RequestContact $requestReceiver
     */
    public function removeRequestReceiver(\FKS\CentralBundle\Entity\RequestContact $requestReceiver)
    {
        $this->requestReceiver->removeElement($requestReceiver);
    }

    /**
     * Get requestReceiver
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRequestReceiver()
    {
        return $this->requestReceiver;
    }

    /**
     * Add contactSender
     *
     * @param \FKS\CentralBundle\Entity\ContactUser $contactSender
     *
     * @return User
     */
    public function addContactSender(\FKS\CentralBundle\Entity\ContactUser $contactSender)
    {
        $this->contactSender[] = $contactSender;

        return $this;
    }

    /**
     * Remove contactSender
     *
     * @param \FKS\CentralBundle\Entity\ContactUser $contactSender
     */
    public function removeContactSender(\FKS\CentralBundle\Entity\ContactUser $contactSender)
    {
        $this->contactSender->removeElement($contactSender);
    }

    /**
     * Get contactSender
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContactSender()
    {
        return $this->contactSender;
    }

    /**
     * Add contact
     *
     * @param \FKS\CentralBundle\Entity\ContactUser $contact
     *
     * @return User
     */
    public function addContact(\FKS\CentralBundle\Entity\ContactUser $contact)
    {
        $this->contact[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \FKS\CentralBundle\Entity\ContactUser $contact
     */
    public function removeContact(\FKS\CentralBundle\Entity\ContactUser $contact)
    {
        $this->contact->removeElement($contact);
    }

    /**
     * Get contact
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set sub
     *
     * @param \FKS\CentralBundle\Entity\subNetwork $sub
     *
     * @return User
     */
    public function setSub(\FKS\CentralBundle\Entity\subNetwork $sub)
    {
        $this->sub = $sub;

        return $this;
    }

    /**
     * Get sub
     *
     * @return \FKS\CentralBundle\Entity\subNetwork
     */
    public function getSub()
    {
        return $this->sub;
    }

    /**
     * Set group
     *
     * @param \FKS\CentralBundle\Entity\Groups $group
     *
     * @return User
     */
    public function setGroup(\FKS\CentralBundle\Entity\Groups $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \FKS\CentralBundle\Entity\Groups
     */
    public function getGroup()
    {
        return $this->group;
    }
}
