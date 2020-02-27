<?php


namespace ClubBundle\Entity;
/**
 * @ORM\Table(name="DemandeAdhesion")
 * @ORM\Entity
 */
use Doctrine\ORM\Mapping as ORM;

class Demandedad
{
    /**
     *
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Club")
     * @ORM\JoinColumn(name="clubId", referencedColumnName="id")
     */
    private $clubId;

    /**
     * @var string
     *
     * @ORM\Column(name="dureInsc", type="string", length=255 )
     */
    private $dureInsc;

    /**
     * @var string
     *
     * @ORM\Column(name="modePayment", type="string", length=255 )
     */
    private $modePayment;

    /**
     * @var integer
     *
     * @ORM\Column(name="etatDemande", type="integer", nullable=true )
     */
    private $etatDemande;

    /**
     * @var integer
     *
     * @ORM\Column(name="numParent", type="integer"  )
     */
    private $numParent;

    /**
     * @var string
     *
     * @ORM\Column(name="ancienClub", type="string", length=255 )
     */
    private $ancienClub;

    /**
     * @var string
     *
     * @ORM\Column(name="objectif", type="string", length=255 )
     */
    private $objectif;

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
    public function getDureInsc()
    {
        return $this->dureInsc;
    }

    /**
     * @param string $dureInsc
     */
    public function setDureInsc($dureInsc)
    {
        $this->dureInsc = $dureInsc;
    }

    /**
     * @return string
     */
    public function getModePayment()
    {
        return $this->modePayment;
    }

    /**
     * @param string $modePayment
     */
    public function setModePayment($modePayment)
    {
        $this->modePayment = $modePayment;
    }

    /**
     * @return int
     */
    public function getEtatDemande()
    {
        return $this->etatDemande;
    }

    /**
     * @param int $etatDemande
     */
    public function setEtatDemande($etatDemande)
    {
        $this->etatDemande = $etatDemande;
    }

    /**
     * @return int
     */
    public function getNumParent()
    {
        return $this->numParent;
    }

    /**
     * @param int $numParent
     */
    public function setNumParent($numParent)
    {
        $this->numParent = $numParent;
    }

    /**
     * @return string
     */
    public function getAncienClub()
    {
        return $this->ancienClub;
    }

    /**
     * @param string $ancienClub
     */
    public function setAncienClub($ancienClub)
    {
        $this->ancienClub = $ancienClub;
    }

    /**
     * @return string
     */
    public function getObjectif()
    {
        return $this->objectif;
    }

    /**
     * @param string $objectif
     */
    public function setObjectif($objectif)
    {
        $this->objectif = $objectif;
    }

    /**
     * @return mixed
     */
    public function getClubId()
    {
        return $this->clubId;
    }

    /**
     * @param mixed $clubId
     */
    public function setClubId($clubId)
    {
        $this->clubId = $clubId;
    }




}