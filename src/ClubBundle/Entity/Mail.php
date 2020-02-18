<?php


namespace ClubBundle\Entity;

/**
 * @ORM\Table(name="Mail")
 * @ORM\Entity
 */
use Doctrine\ORM\Mapping as ORM;
class Mail
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
     * @ORM\Column(name="subject", type="string", length=255 )
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255 )
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255 )
     */
    private $objet;

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
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * @param string $objet
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
    }

}