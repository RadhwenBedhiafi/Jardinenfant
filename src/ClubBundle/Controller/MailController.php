<?php

namespace ClubBundle\Controller;

use ClubBundle\Entity\Maila;
use ClubBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{


public function sendMailAction(Request $request)
{
    $mail = new Maila();
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
        echo "<script> 
                function notifyMe() {
            if (!(\"Notification\" in window)) {
                alert(\"This browser does not support system notifications\");
            }
            else if (Notification.permission === \"granted\") {
                notify();
            }
            else if (Notification.permission !== 'denied') {
                Notification.requestPermission(function (permission) {
                    if (permission === \"granted\") {
                        notify();
                    }
                });
            }

            function notify() {
                var notification = new Notification('MAIL', {
                    icon: 'http://urls.ml/5yc3a',
                    body: Maila",

                });

                setTimeout(notification.close.bind(notification), 5000);
            }

        }
        notifyMe(); </script>";
    }

    return $this->render('@Club/Default/sendMail.html.twig',
    array('form' => $form->createView()));
}
}
