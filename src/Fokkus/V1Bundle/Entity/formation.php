<?php

namespace Fokkus\V1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="Fokkus\V1Bundle\Repository\formationRepository")
 */
class formation
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
   * @ORM\ManyToOne(targetEntity="Fokkus\V1Bundle\Entity\formationcateg")
   * @ORM\JoinColumn(nullable=false)
   */
  private $formationcateg;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;


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
     * @return formation
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
     * Set prix
     *
     * @param integer $prix
     *
     * @return formation
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set formationcateg
     *
     * @param \Fokkus\V1Bundle\Entity\formationcateg $formationcateg
     *
     * @return formation
     */
    public function setFormationcateg(\Fokkus\V1Bundle\Entity\formationcateg $formationcateg)
    {
        $this->formationcateg = $formationcateg;

        return $this;
    }

    /**
     * Get formationcateg
     *
     * @return \Fokkus\V1Bundle\Entity\formationcateg
     */
    public function getFormationcateg()
    {
        return $this->formationcateg; 
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return formation
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
}
