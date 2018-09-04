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
            $name = $contactFormData['name'];
            $firstName = $contactFormData['firstName'];

            $message = (new \Swift_Message('Vous avez un nouveau message!'))
                    ->setFrom($contactFormData['email'])
                    ->setTo('laukorn666@gmail.com')
                    ->setBody(
                    $contactFormData['message'], 'text/html'
            );

            $mailer->send($message);

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/contact.html.twig', [
                    'our_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact/index", name="contact_index", methods="GET|POST")
     */
    public function contactIndex(Request $request) {

        return $this->render('contact/index.html.twig', ['mailer' => $request]);
    }

}
