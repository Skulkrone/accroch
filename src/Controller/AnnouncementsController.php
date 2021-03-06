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
        return $this->render('announcements/index.html.twig', ['announcements' => $announcementsRepository->findAll(),
            'annonces' => $announcementsRepository->triSQL()
            ]);
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
        $now = new \DateTime();
        $announcement->setCreationDate($now);
        $announcement->setFkUserId($this->getUser());
        $form = $this->createForm(AnnouncementsType::class, $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $announcement->getImageAnnouncements();
            $fileTwo = $announcement->getImageAnnouncementsTwo();
            $fileThree = $announcement->getImageAnnouncementsThree();

            $fileName = $this->generateOneFileName() . '.' . $file->guessExtension();
            $fileNameTwo = $this->generateOneFileName() . '.' . $fileTwo->guessExtension();
            $fileNameThree = $this->generateOneFileName() . '.' . $fileThree->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('annonce_directory'), $fileName
            );
            $fileTwo->move(
                    $this->getParameter('annonce_directory'), $fileNameTwo
            );
            $fileThree->move(
                    $this->getParameter('annonce_directory'), $fileNameThree
            );

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $announcement->setImageAnnouncements($fileName);
            $announcement->setImageAnnouncementsTwo($fileNameTwo);
            $announcement->setImageAnnouncementsThree($fileNameThree);
            
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
        $now = new \DateTime();
        $announcement->setCreationDate($now);
        $announcement->setFkUserId($this->getUser());
        $form = $this->createForm(AnnouncementsType::class, $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $announcement->getImageAnnouncements();
            $fileTwo = $announcement->getImageAnnouncementsTwo();
            $fileThree = $announcement->getImageAnnouncementsThree();

            $fileName = $this->generateOneFileName() . '.' . $file->guessExtension();
            $fileNameTwo = $this->generateOneFileName() . '.' . $fileTwo->guessExtension();
            $fileNameThree = $this->generateOneFileName() . '.' . $fileThree->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('annonce_directory'), $fileName
            );
            $fileTwo->move(
                    $this->getParameter('annonce_directory'), $fileNameTwo
            );
            $fileThree->move(
                    $this->getParameter('annonce_directory'), $fileNameThree
            );

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $announcement->setImageAnnouncements($fileName);
            $announcement->setImageAnnouncementsTwo($fileNameTwo);
            $announcement->setImageAnnouncementsThree($fileNameThree);
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('announcements_show', ['id' => $announcement->getId()]);
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
    
    /**
     * @return string
     */
    private function generateOneFileName() {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    
}
