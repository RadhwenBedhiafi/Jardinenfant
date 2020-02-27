<?php

namespace ForumBundle\Entity;
/**
 * @ORM\Table(name="Article")
 * @ORM\Entity
 */
use Doctrine\ORM\Mapping as ORM;

class Article
{
    /**
     *
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255 )
     */
    private $titre;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255 )
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;
    /**
     * @var \DateSaisie
     *
     * @ORM\Column(name="dateSaisie", type="date", nullable=false)
     */
    private $dateSaisie;

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
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
     * @return \DateSaisie
     */
    public function getDateSaisie()
    {
        return $this->dateSaisie;
    }

    /**
     * @param \DateSaisie $dateSaisie
     */
    public function setDateSaisie($dateSaisie)
    {
        $this->dateSaisie = $dateSaisie;
    }
    public function __construct()
    {
        $this->dateSaisie = new \DateTime('now');
    }


}