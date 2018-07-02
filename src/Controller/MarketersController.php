<?php

namespace App\Controller;

use App\Entity\Marketers;
use App\Form\MarketersType;
use App\Repository\MarketersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marketers")
 */
class MarketersController extends Controller
{
    /**
     * @Route("/", name="marketers_index", methods="GET")
     */
    public function index(MarketersRepository $marketersRepository): Response
    {
        return $this->render('marketers/index.html.twig', ['marketers' => $marketersRepository->findAll()]);
    }

    /**
     * @Route("/new", name="marketers_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $marketer = new Marketers();
        $form = $this->createForm(MarketersType::class, $marketer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($marketer);
            $em->flush();

            return $this->redirectToRoute('marketers_index');
        }

        return $this->render('marketers/new.html.twig', [
            'marketer' => $marketer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="marketers_show", methods="GET")
     */
    public function show(Marketers $marketer): Response
    {
        return $this->render('marketers/show.html.twig', ['marketer' => $marketer]);
    }

    /**
     * @Route("/{id}/edit", name="marketers_edit", methods="GET|POST")
     */
    public function edit(Request $request, Marketers $marketer): Response
    {
        $form = $this->createForm(MarketersType::class, $marketer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('marketers_edit', ['id' => $marketer->getId()]);
        }

        return $this->render('marketers/edit.html.twig', [
            'marketer' => $marketer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="marketers_delete", methods="DELETE")
     */
    public function delete(Request $request, Marketers $marketer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$marketer->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($marketer);
            $em->flush();
        }

        return $this->redirectToRoute('marketers_index');
    }
}
