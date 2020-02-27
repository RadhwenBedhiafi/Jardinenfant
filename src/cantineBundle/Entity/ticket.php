<?php

namespace cantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="cantineBundle\Repository\ticketRepository")
 */
class ticket
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
     *
     *
     */
    private $nomPlat;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_plat", type="integer", nullable=false)
     */
    private $id_plat;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $id_user;




    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="photoPlat", type="string", length=255)
     *
     */
    private $photoPlat;


    /**
     * Get id
     *
     * @return int
     */

    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    /**
     * @return string
     */
    public function getNomPlat()
    {
        return $this->nomPlat;
    }

    /**
     * @param string $nomPlat
     */
    public function setNomPlat($nomPlat)
    {
        $this->nomPlat = $nomPlat;
    }

    /**
     * @return int
     */
    public function getIdPlat()
    {
        return $this->id_plat;
    }

    /**
     * @param int $id_plat
     */
    public function setIdPlat($id_plat)
    {
        $this->id_plat = $id_plat;
    }

    /**
     * @return int
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getPhotoPlat()
    {
        return $this->photoPlat;
    }

    /**
     * @param string $photoPlat
     */
    public function setPhotoPlat($photoPlat)
    {
        $this->photoPlat = $photoPlat;
    }






}

