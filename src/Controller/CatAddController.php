<?php

namespace App\Controller;

use App\Entity\CatAdd;
use App\Form\CatAddType;
use App\Repository\CatAddRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cat/add")
 */
class CatAddController extends Controller
{
    /**
     * @Route("/", name="cat_add_index", methods="GET")
     */
    public function index(CatAddRepository $catAddRepository): Response
    {
        return $this->render('cat_add/index.html.twig', ['cat_adds' => $catAddRepository->findAll()]);
    }

    /**
     * @Route("/new", name="cat_add_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $catAdd = new CatAdd();
        $form = $this->createForm(CatAddType::class, $catAdd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catAdd);
            $em->flush();

            return $this->redirectToRoute('cat_add_index');
        }

        return $this->render('cat_add/new.html.twig', [
            'cat_add' => $catAdd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cat_add_show", methods="GET")
     */
    public function show(CatAdd $catAdd): Response
    {
        return $this->render('cat_add/show.html.twig', ['cat_add' => $catAdd]);
    }

    /**
     * @Route("/{id}/edit", name="cat_add_edit", methods="GET|POST")
     */
    public function edit(Request $request, CatAdd $catAdd): Response
    {
        $form = $this->createForm(CatAddType::class, $catAdd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cat_add_edit', ['id' => $catAdd->getId()]);
        }

        return $this->render('cat_add/edit.html.twig', [
            'cat_add' => $catAdd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cat_add_delete", methods="DELETE")
     */
    public function delete(Request $request, CatAdd $catAdd): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catAdd->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catAdd);
            $em->flush();
        }

        return $this->redirectToRoute('cat_add_index');
    }
}
