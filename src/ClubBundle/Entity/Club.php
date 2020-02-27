<?php


namespace ClubBundle\Entity;
/**
 * @ORM\Table(name="Club")
 * @ORM\Entity
 */
use Doctrine\ORM\Mapping as ORM;

class Club
{
    /**
     *
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="nomclub", type="string", length=255 )
     */
    private $nomclub;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255 )
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="horraire", type="string", length=255 )
     */
    private $horraire;
    /**
     * @var integer
     *
     * @ORM\Column(name="tarif", type="integer", length=255, nullable=false)
     */
    private $tarif;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;
    /**
     * @var integer
     *
     * @ORM\Column(name="capacite", type="integer", length=255, nullable=false)
     */
    private $capacite;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getHorraire()
    {
        return $this->horraire;
    }

    /**
     * @param string $horraire
     */
    public function setHorraire($horraire)
    {
        $this->horraire = $horraire;
    }

    /**
     * @return int
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * @param int $tarif
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * @param int $capacite
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;
    }

    /**
     * @return string
     */
    public function getNomclub()
    {
        return $this->nomclub;
    }

    /**
     * @param string $nomclub
     */
    public function setNomclub($nomclub)
    {
        $this->nomclub = $nomclub;
    }










}