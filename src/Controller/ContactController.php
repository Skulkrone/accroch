<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController {

    /**
     * @Route("/contact", name="contact", methods="GET|POST")
     */
    public function contact(Request $request, \Swift_Mailer $mailer) {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();
            //print_r($contactFormData);

            $message = (new \Swift_Message('Vous avez un nouveau message!'))
            ->setFrom($contactFormData['email'])
            ->setTo('punchyguy@mailinator.com')
            ->setBody(
                    $contactFormData['message'],
                    'text/plain'
            );
            
            $mailer->send($message);
        }

        return $this->render('contact/index.html.twig', [
                    'our_form' => $form->createView(),
        ]);
    }

}
