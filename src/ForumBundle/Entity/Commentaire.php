<?php


namespace ForumBundle\Entity;
/**
 * @ORM\Table(name="Commentaire")
 * @ORM\Entity
 */
use Doctrine\ORM\Mapping as ORM;

class Commentaire
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
     * @ORM\Column(name="contenu", type="string", length=255 )
     */
    private $contenu;
    /**
     * @var \DateSaisie
     *
     * @ORM\Column(name="dateSaisie", type="datetime", nullable=false)
     */
    private $dateSaisie;
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="idArticle", referencedColumnName="id",nullable=true,onDelete="SET NULL")
     */
    private $idArticle;
    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255 )
     */
    private $user;

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

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
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
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

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * @param mixed $idArticle
     */
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;
    }

    public function __construct()
    {
        $this->dateSaisie = new \DateTime('now');
    }
    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return (string) $this->IdArticle;
    }
}