<?php

namespace eventBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use eventBundle\eventBundle;
use EventsBundle\Entity\Categorie;
use EventsBundle\EventsBundle;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * plan_event
 *
 * @ORM\Table(name="plan_event")
 * @ORM\Entity(repositoryClass="eventBundle\Repository\PlanEventRepository")
 */
class PlanEvent
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="date_debut", type="date")
     */

    private  $date_debut;


    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private  $date_fin;


    /**
     * @var string
     *
     *@ORM\Column(name="titre", type="string", length=255)
     *@Assert\Regex(
     *     pattern      ="/^[a-z]+$/i",
     *     htmlPattern  ="^[a-zA-Z]+$",)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity="eventBundle\Entity\evennements")
     * @ORM\JoinColumn(name="id_event", referencedColumnName="id")
     */
    private $id_event;

    /**
     * PlanEvent constructor.
     */
    public function __construct()
    {
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
     * @return string
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * @param string $date_debut
     */
    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    /**
     * @return string
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }

    /**
     * @param string $date_fin
     */
    public function setDateFin($date_fin)
    {
        $this->date_fin = $date_fin;
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
     * @return eventBundle/Entity/evennements
     */
    public function getIdEvent()
    {
        return $this->id_event;
    }

    /**
     * @param eventBundle/Entity/evennements $id_event
     * @return evennements
     */
    public function setIdEvent($id_event)
    {
        $this->id_event = $id_event;
    }


}

