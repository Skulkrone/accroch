<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Entity\Announcements;
use App\Entity\User;
use App\Form\MessagesType;
use App\Repository\MessagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/messages")
 */
class MessagesController extends Controller {

    /**
     * @Route("/", name="messages_index", methods="GET")
     */
    public function index(MessagesRepository $messagesRepository): Response {
        
        return $this->render('messages/index.html.twig', ['userId' => $messagesRepository->messagesSQL()]);
        }

        /**
         * @Route("/new", name="messages_new", methods="GET|POST")
         */
        public function new(Request $request): Response
        {
        $message = new Messages();
        $now = new \DateTime();
        $message->setCreatedAt($now);
        $message->setFkFromUserId($this->getUser());
        //$message->setFkToUserId($this->getId());

        //$mes = $_GET['id'];
        /* $tag = $request->query->get('id');
          echo $tag; */
        /* $request->request->get('id');
          echo $request; */

        //$message = $messagesRepository->getId()->get);

        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        $em = $this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();


        return $this->redirectToRoute('messages_index');
        }

        return $this->render('messages/new.html.twig', [
                    'message' => $message,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="messages_show", methods="GET")
     */
    public function show(MessagesRepository $messagesRepository, User $users, Messages $message): Response {
        $users->getUsername();
        return $this->render('messages/show.html.twig', ['userId' => $messagesRepository->messagesSQL(), 'users'=>$users, 'message' => $message]);
    }
    
     /**
     * name="messages_show", methods="POST")
     */
    public function store(Request $request, User $users): Response {
        $users->getUsername();
        return $this->render('messages/show.html.twig', ['userId' => $messagesRepository->messagesSQL(), 'users'=>$users]);
    }


    /**
     * @Route("/{id}/edit", name="messages_edit", methods="GET|POST")
     */
    public function edit(Request $request, Messages $message): Response {
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('messages_edit', ['id' => $message->getId()]);
        }

        return $this->render('messages/edit.html.twig', [
                    'message' => $message,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="messages_delete", methods="DELETE")
     */
    public function delete(Request $request, Messages $message): Response {
        if ($this->isCsrfTokenValid('delete' . $message->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($message);
            $em->flush();
        }

        return $this->redirectToRoute('messages_index');
    }

}
