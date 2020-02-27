<?php

namespace transportBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use SBC\NotificationsBundle\Builder\NotificationBuilder;
use SBC\NotificationsBundle\Model\NotifiableInterface;


/**
 * ligneTransport
 *
 * @ORM\Table(name="ligne_transport")
 * @ORM\Entity(repositoryClass="transportBundle\Repository\ligneTransportRepository")
 */
class ligneTransport implements NotifiableInterface ,\JsonSerializable
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
     * ligneTransport constructor.
     * @param $Enfant
     */
    public function __construct()
    {
        $this->enfant = new ArrayCollection() ;
    }



    /**
     * @ORM\OneToMany(targetEntity="EnfantBundle\Entity\Enfant", mappedBy="ligneTransport")
     * * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private  $enfant;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="ligneTransport")
     * * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private  $User;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param mixed $User
     */
    public function setUser($User)
    {
        $this->User = $User;
    }
    /**
     * @ORM\OneToOne(targetEntity="chauffeur", cascade={"remove"})
     */
    private $chauffeur;

    /**
     * @return mixed
     */
    public function getChauffeur()
    {
        return $this->chauffeur;
    }

    /**
     * @param mixed $chauffeur
     */
    public function setChauffeur($chauffeur)
    {
        $this->chauffeur = $chauffeur;
    }

    /**
     * @return ArrayCollection
     */
    public function getEnfant()
    {
        return $this->enfant;
    }

    /**
     * @return mixed
     */
    public function getChauffeurl()
    {
        return $this->chauffeurl;
    }

    /**
     * @param mixed $chauffeurl
     */
    public function setChauffeurl($chauffeurl)
    {
        $this->chauffeurl = $chauffeurl;
    }




    /**
     * @param ArrayCollection $enfant
     */
    public function setEnfant($enfant)
    {
        $this->enfant = $enfant;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDepart", type="time")
     */
    private $heureDepart;

    /**
     * @var string
     * @ORM\Column(name="station", type="string", length=255)
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",
     * )
     */
    private $station;

    /**
     * @var string
     * @ORM\Column(name="vehicule", type="string", length=255)
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",
     * )
     */
    private $vehicule;

    /**
     * @var float
     *
     * @ORM\Column(name="tarif", type="float")
     */
    private $tarif;

    /**
     * @var \capacite
     * @ORM\Column(name="capacite", type="integer")
     * @Assert\GreaterThan(value=0, message="L'age doit etre superieur a zero")
     */
    private $capacite;

    /**
     * @return \capacite
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * @param \capacite $capacite
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;
    }








    /**
     * @var \nbPlaces
     * @ORM\Column(name="nbPlaces", type="integer",nullable=true)
     */
    private $nbPlaces;

    /**
     * @return \nbPlaces
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * @param \nbPlaces $nbPlaces
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;
    }















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
     * Set heureDepart
     *
     * @param \Time $heureDepart
     *
     * @return ligneTransport
     */
    public function setHeureDepart($heureDepart)
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    /**
     * Get heureDepart
     *
     * @return \Time
     */
    public function getHeureDepart()
    {
        return $this->heureDepart;
    }

    /**
     * Set station
     *
     * @param string $station
     *
     * @return ligneTransport
     */
    public function setStation($station)
    {
        $this->station = $station;

        return $this;
    }

    /**
     * Get station
     *
     * @return string
     */
    public function getStation()
    {
        return $this->station;
    }

    /**
     * Set vehicule
     *
     * @param string $vehicule
     *
     * @return ligneTransport
     */
    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get vehicule
     *
     * @return string
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * Set tarif
     *
     * @param float $tarif
     *
     * @return ligneTransport
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return float
     */
    public function getTarif()
    {
        return $this->tarif;
    }
    public function __toString()
    {
        return (string) $this->getId();
    }




/**
 * notification configuration de notifier en update et create
*/

    function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function notificationsOnCreate(NotificationBuilder $builder)
    {
        $notification = new Notification();
        $notification
            ->setTitle('New ligneTransport')
            ->setDescription('une nouvelle ligne de transport est crée "' . $this->station . '"')
            ->setRoute('lignetransport_showf')
            ->setParameters(array('id' => $this->id));
        $builder->addNotification($notification);

        return $builder;
    }

    public function notificationsOnUpdate(NotificationBuilder $builder)
    {
        $notification = new Notification();
        $notification
            ->setTitle('ligne de transport modifiée')
            ->setDescription('la ligne a été modifié '.$this->station.'" has been updated')
            ->setRoute('lignetransport_showf')
            ->setParameters(array('id' => $this->id))
        ;
        $builder->addNotification($notification);

        return $builder;
    }

    public function notificationsOnDelete(NotificationBuilder $builder)
    {
        // in case you don't want any notification for a special event
        // you can simply return an empty $builder
        return $builder;
    }














}

