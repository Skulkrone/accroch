<?php

namespace App\Controller;

use App\Entity\CatShop;
use App\Form\CatShopType;
use App\Repository\CatShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cat/shop")
 */
class CatShopController extends Controller
{
    /**
     * @Route("/", name="cat_shop_index", methods="GET")
     */
    public function index(CatShopRepository $catShopRepository): Response
    {
        return $this->render('cat_shop/index.html.twig', ['cat_shops' => $catShopRepository->findAll()]);
    }

    /**
     * @Route("/new", name="cat_shop_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $catShop = new CatShop();
        $form = $this->createForm(CatShopType::class, $catShop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catShop);
            $em->flush();

            return $this->redirectToRoute('cat_shop_index');
        }

        return $this->render('cat_shop/new.html.twig', [
            'cat_shop' => $catShop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cat_shop_show", methods="GET")
     */
    public function show(CatShop $catShop): Response
    {
        return $this->render('cat_shop/show.html.twig', ['cat_shop' => $catShop]);
    }

    /**
     * @Route("/{id}/edit", name="cat_shop_edit", methods="GET|POST")
     */
    public function edit(Request $request, CatShop $catShop): Response
    {
        $form = $this->createForm(CatShopType::class, $catShop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cat_shop_edit', ['id' => $catShop->getId()]);
        }

        return $this->render('cat_shop/edit.html.twig', [
            'cat_shop' => $catShop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cat_shop_delete", methods="DELETE")
     */
    public function delete(Request $request, CatShop $catShop): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catShop->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catShop);
            $em->flush();
        }

        return $this->redirectToRoute('cat_shop_index');
    }
}
