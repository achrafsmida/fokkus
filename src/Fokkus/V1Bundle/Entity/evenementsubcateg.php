<?php

namespace Fokkus\V1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * evenementsubcateg 
 *
 * @ORM\Table(name="evenementsubcateg")
 * @ORM\Entity(repositoryClass="Fokkus\V1Bundle\Repository\evenementsubcategRepository")
 */
class evenementsubcateg
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
   * @ORM\ManyToOne(targetEntity="Fokkus\V1Bundle\Entity\evenementcateg")
   * @ORM\JoinColumn(nullable=false)
   */
  private $evenementcateg;
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
     * @return evenementsubcateg
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
        $this->evenementcateg = new \Doctrine\Common\Collections\ArrayCollection();
    }
 
   
 
      public function __tostring()
    {
        return $this->nom;
    }

  
 

    /**
     * Add evenementcateg
     *
     * @param \Fokkus\V1Bundle\Entity\evenementcateg $evenementcateg
     *
     * @return evenementsubcateg
     */
    public function addEvenementcateg(\Fokkus\V1Bundle\Entity\evenementcateg $evenementcateg)
    {
        $this->evenementcateg[] = $evenementcateg;

        return $this;
    }

    /**
     * Remove evenementcateg
     *
     * @param \Fokkus\V1Bundle\Entity\evenementcateg $evenementcateg
     */
    public function removeEvenementcateg(\Fokkus\V1Bundle\Entity\evenementcateg $evenementcateg)
    {
        $this->evenementcateg->removeElement($evenementcateg);
    }

    /**
     * Get evenementcateg
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenementcateg()
    {
        return $this->evenementcateg;
    }

    /**
     * Set evenementcateg
     *
     * @param \Fokkus\V1Bundle\Entity\evenementcateg $evenementcateg
     *
     * @return evenementsubcateg
     */
    public function setEvenementcateg(\Fokkus\V1Bundle\Entity\evenementcateg $evenementcateg)
    {
        $this->evenementcateg = $evenementcateg;

        return $this;
    }
}
