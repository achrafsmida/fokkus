<?php

namespace Fokkus\V1Bundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;

/**
 * evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="Fokkus\V1Bundle\Repository\evenementRepository")
 */
class evenement
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
   * @ORM\ManyToOne(targetEntity="Fokkus\V1Bundle\Entity\evenementsubcateg")
   * @ORM\JoinColumn(nullable=false)
   */
  private $evenementsubcateg;
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
     * @return evenement
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
     * @return evenement
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
     * Set evenementcateg
     *
     * @param \Fokkus\V1Bundle\Entity\evenementcateg $evenementcateg
     *
     * @return evenement
     */
    public function setFormationcateg(\Fokkus\V1Bundle\Entity\evenementcateg $evenementcateg)
    {
        $this->evenementcateg = $evenementcateg;

        return $this;
    }

    /**
     * Get evenementcateg
     *
     * @return \Fokkus\V1Bundle\Entity\evenementcateg
     */
    public function getFormationcateg()
    {
        return $this->evenementcateg; 
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return evenement
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
     * Set evenementcateg
     *
     * @param \Fokkus\V1Bundle\Entity\evenementcateg $evenementcateg
     *
     * @return evenement
     */
    public function setEvenementcateg(\Fokkus\V1Bundle\Entity\evenementcateg $evenementcateg)
    {
        $this->evenementcateg = $evenementcateg;

        return $this;
    }

    /**
     * Get evenementcateg
     *
     * @return \Fokkus\V1Bundle\Entity\evenementcateg
     */
    public function getEvenementcateg()
    {
        return $this->evenementcateg;
    }

    /**
     * Set evenementsubcateg
     *
     * @param \Fokkus\V1Bundle\Entity\evenementsubcateg $evenementsubcateg
     *
     * @return evenement
     */
    public function setEvenementsubcateg(\Fokkus\V1Bundle\Entity\evenementsubcateg $evenementsubcateg)
    {
        $this->evenementsubcateg = $evenementsubcateg;

        return $this;
    }

    /**
     * Get evenementsubcateg
     *
     * @return \Fokkus\V1Bundle\Entity\evenementsubcateg
     */
    public function getEvenementsubcateg()
    {
        return $this->evenementsubcateg;
    }
}
