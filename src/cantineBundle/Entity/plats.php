<?php

namespace cantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * plats
 *
 * @ORM\Table(name="plats")
 * @ORM\Entity(repositoryClass="cantineBundle\Repository\platsRepository")
 */
class plats
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
     * @ORM\Column(name="nomPlat", type="string", length=255)
     * * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",
     * )
     *
     */
    private $nomPlat;

    /**
     * @var string
     *
     * @ORM\Column(name="photoPlat", type="string", length=255)
     * * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",
     * )
     */
    private $photoPlat;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",
     * )
     */
    private $description;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;




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
     * Set nomPlat
     *
     * @param string $nomPlat
     *
     * @return plats
     */
    public function setNomPlat($nomPlat)
    {
        $this->nomPlat = $nomPlat;

        return $this;
    }

    /**
     * Get nomPlat
     *
     * @return string
     */
    public function getNomPlat()
    {
        return $this->nomPlat;
    }

    /**
     * Set photoPlat
     *
     * @param string $photoPlat
     *
     * @return plats
     */
    public function setPhotoPlat($photoPlat)
    {
        $this->photoPlat = $photoPlat;

        return $this;
    }

    /**
     * Get photoPlat
     *
     * @return string
     */
    public function getPhotoPlat()
    {
        return $this->photoPlat;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return plats
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
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


}

