<?php

namespace AppBundle\Entity;

use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string",length=255)
     *
     */
    private $nom;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    /**
     * @ORM\Column(type="string",length=255)
     *
     */
    private $prenom;

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }





    /**
     * @ORM\ManyToOne(targetEntity="transportBundle\Entity\ligneTransport", inversedBy="Users")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $ligneTransport;

    /**
     * @return mixed
     */
    public function getLigneTransport()
    {
        return $this->ligneTransport;
    }

    /**
     * @param mixed $ligneTransport
     */
    public function setLigneTransport($ligneTransport)
    {
        $this->ligneTransport = $ligneTransport;
    }





    /**
     * @var \valid
     * @ORM\Column(name="valid", type="integer",nullable=true)
     */
    private $valid;

    /**
     * @return \valid
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param \valid $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }



    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}