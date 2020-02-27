<?php

namespace ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ForumBundle\Entity\Mail;
use ForumBundle\Form\MailType;
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
            $object = $request->get('form') ['object'];
            $username = 'najibaamri23@gmail.com';
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($username)
                ->setTo($mail)
                ->setBody($object);
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
                    body: 'Hey! Mail envoyé avec succés'         });

                setTimeout(notification.close.bind(notification), 5000);
            }

        }
        notifyMe(); </script>";
        }
        return $this->render('@Forum/Default/send_mail.html.twig',
            array('form' => $form->createView()));
    }

}
