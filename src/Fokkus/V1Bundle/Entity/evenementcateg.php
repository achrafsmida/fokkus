<?php

namespace Fokkus\V1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * evenementcateg 
 *
 * @ORM\Table(name="evenementcateg")
 * @ORM\Entity(repositoryClass="Fokkus\V1Bundle\Repository\evenementcategRepository")
 */
class evenementcateg
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
   * @ORM\OneToMany(targetEntity="Fokkus\V1Bundle\Entity\evenement", mappedBy="evenementcateg")
   */
  private $evenement; 
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return evenementcateg
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evenement = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add evenement
     *
     * @param \Fokkus\V1Bundle\Entity\evenement $evenement
     *
     * @return evenementcateg
     */
    public function addEvenement(\Fokkus\V1Bundle\Entity\evenement $evenement)
    {
        $this->evenement[] = $evenement;

        return $this;
    }

    /**
     * Remove evenement
     *
     * @param \Fokkus\V1Bundle\Entity\evenement $evenement
     */
    public function removeEvenement(\Fokkus\V1Bundle\Entity\evenement $evenement)
    {
        $this->evenement->removeElement($evenement);
    }

 
      public function __tostring()
    {
        return $this->nom;
    }

   

   
    /**
     * Get evenement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenement()
    {
        return $this->evenement;
    }
}
