<?php

namespace Fokkus\V1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * formationcateg
 *
 * @ORM\Table(name="formationcateg")
 * @ORM\Entity(repositoryClass="Fokkus\V1Bundle\Repository\formationcategRepository")
 */
class formationcateg
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
   * @ORM\OneToMany(targetEntity="Fokkus\V1Bundle\Entity\formation", mappedBy="formationcateg")
   */
  private $formation; 
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
     * @return formationcateg
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
        $this->formation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add formation
     *
     * @param \Fokkus\V1Bundle\Entity\formation $formation
     *
     * @return formationcateg
     */
    public function addFormation(\Fokkus\V1Bundle\Entity\formation $formation)
    {
        $this->formation[] = $formation;

        return $this;
    }

    /**
     * Remove formation
     *
     * @param \Fokkus\V1Bundle\Entity\formation $formation
     */
    public function removeFormation(\Fokkus\V1Bundle\Entity\formation $formation)
    {
        $this->formation->removeElement($formation);
    }

    /**
     * Get formation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormation()
    {
        return $this->formation;
    }
      public function __tostring()
    {
        return $this->nom;
    }
}
