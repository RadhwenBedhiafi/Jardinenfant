<?php

namespace ClubBundle\Controller;

use ClubBundle\Entity\Mail;
use ClubBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{


public function sendMailAction(Request $request)
{
    $mail = new Mail();
    $form = $this->createForm(MailType::class, $mail);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $subject = $mail->getSubject();
      $mail = $mail->getMail();
      $objet = $request->get('form') ['objet'];
      $username = 'najibaamri23@gmail.com';
      $message = \Swift_Message::newInstance()
      ->setSubject($subject)
      ->setFrom($username)
      ->setTo($mail)
      ->setBody($objet);
      $this->get('mailer')->send($message);
      $this->get('session')->getFlashBag()->add('notice','message envoye avec success');
    }
    return $this->render('@Club/Default/sendMail.html.twig',
    array('form' => $form->createView()));
}
}
