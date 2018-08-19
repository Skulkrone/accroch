<?php

namespace App\Controller;

use App\Entity\CatAnnouncements;
use App\Form\CatAnnouncementsType;
use App\Repository\CatAnnouncementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cat/announcements")
 */
class CatAnnouncementsController extends Controller
{
    /**
     * @Route("/", name="cat_announcements_index", methods="GET")
     */
    public function index(CatAnnouncementsRepository $catAnnouncementsRepository): Response
    {
        return $this->render('cat_announcements/index.html.twig', ['cat_announcements' => $catAnnouncementsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="cat_announcements_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $catAnnouncement = new CatAnnouncements();
        $form = $this->createForm(CatAnnouncementsType::class, $catAnnouncement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catAnnouncement);
            $em->flush();

            return $this->redirectToRoute('cat_announcements_index');
        }

        return $this->render('cat_announcements/new.html.twig', [
            'cat_announcement' => $catAnnouncement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cat_announcements_show", methods="GET")
     */
    public function show(CatAnnouncements $catAnnouncement): Response
    {
        return $this->render('cat_announcements/show.html.twig', ['cat_announcement' => $catAnnouncement]);
    }

    /**
     * @Route("/{id}/edit", name="cat_announcements_edit", methods="GET|POST")
     */
    public function edit(Request $request, CatAnnouncements $catAnnouncement): Response
    {
        $form = $this->createForm(CatAnnouncementsType::class, $catAnnouncement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cat_announcements_edit', ['id' => $catAnnouncement->getId()]);
        }

        return $this->render('cat_announcements/edit.html.twig', [
            'cat_announcement' => $catAnnouncement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cat_announcements_delete", methods="DELETE")
     */
    public function delete(Request $request, CatAnnouncements $catAnnouncement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catAnnouncement->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catAnnouncement);
            $em->flush();
        }

        return $this->redirectToRoute('cat_announcements_index');
    }
}
