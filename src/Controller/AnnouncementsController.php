<?php

namespace App\Controller;

use App\Entity\Announcements;
use App\Form\AnnouncementsType;
use App\Repository\AnnouncementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/announcements")
 */
class AnnouncementsController extends Controller
{
    /**
     * @Route("/", name="announcements_index", methods="GET")
     */
    public function index(AnnouncementsRepository $announcementsRepository): Response
    {
        return $this->render('announcements/index.html.twig', ['announcements' => $announcementsRepository->findAll()]);
    }
    
    /**
     * @Route("/example", name="announcements_example", methods="GET")
     */
    public function example(AnnouncementsRepository $announcementsRepository): Response
    {
        return $this->render('announcements/example.html.twig', ['announcements' => $announcementsRepository->findAll()]);
    }
    
    
    /**
     * @Route("/new", name="announcements_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $announcement = new Announcements();
        $form = $this->createForm(AnnouncementsType::class, $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($announcement);
            $em->flush();

            return $this->redirectToRoute('announcements_index');
        }

        return $this->render('announcements/new.html.twig', [
            'announcement' => $announcement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="announcements_show", methods="GET")
     */
    public function show(Announcements $announcement): Response
    {
        return $this->render('announcements/show.html.twig', ['announcement' => $announcement]);
    }

    /**
     * @Route("/{id}/edit", name="announcements_edit", methods="GET|POST")
     */
    public function edit(Request $request, Announcements $announcement): Response
    {
        $form = $this->createForm(AnnouncementsType::class, $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('announcements_edit', ['id' => $announcement->getId()]);
        }

        return $this->render('announcements/edit.html.twig', [
            'announcement' => $announcement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="announcements_delete", methods="DELETE")
     */
    public function delete(Request $request, Announcements $announcement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$announcement->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($announcement);
            $em->flush();
        }

        return $this->redirectToRoute('announcements_index');
    }
    
    
}
