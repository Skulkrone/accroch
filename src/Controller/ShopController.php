<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Form\ShopType;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/shop")
 */
class ShopController extends Controller {

    /**
     * @Route("/", name="shop_index", methods="GET")
     */
    public function index(ShopRepository $shopRepository): Response {
        return $this->render('shop/index.html.twig', ['shops' => $shopRepository->findAll()]);
        }

        /**
         * @Route("/new", name="shop_new", methods="GET|POST")
         */
        public function new(Request $request): Response
        {
        $shop = new Shop();
        $form = $this->createForm(ShopType::class, $shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        $fileOne = $shop->getShopImage();
        $fileTwo = $shop->getLogo();

        $fileNameOne = $this->generateUniqueFilename().'.'.$fileOne->guessExtension();
        $fileNameTwo = $this->generateUniqueFilename().'.'.$fileTwo->guessExtension();

        $fileOne->move($this->getParameter('avatar_directory'), $fileName);
        $fileTwo->move($this->getParameter('avatar_directory'), $fileName);

        $shop->setShopImage($fileNameOne);
        $shop->setLogo($fileNameTwo);


        $em = $this->getDoctrine()->getManager();
        $em->persist($shop);
        $em->flush();

        return $this->redirectToRoute('shop_index');
        }

        return $this->render('shop/new.html.twig', [
                    'shop' => $shop,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFilename() {
        return md5(uniqid());
    }

    /**
     * @Route("/{id}", name="shop_show", methods="GET")
     */
    public function show(Shop $shop): Response {
        return $this->render('shop/show.html.twig', ['shop' => $shop]);
    }

    /**
     * @Route("/{id}/edit", name="shop_edit", methods="GET|POST")
     */
    public function edit(Request $request, Shop $shop): Response {
        $form = $this->createForm(ShopType::class, $shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $fileOne = $shop->getShopImage();
            $fileTwo = $shop->getLogo();

            $fileNameOne = $this->generateFilename() . '.' . $fileOne->guessExtension();
            $fileNameTwo = $this->generateFilename() . '.' . $fileTwo->guessExtension();

            $fileOne->move($this->getParameter('avatar_directory'), $fileNameOne);
            $fileTwo->move($this->getParameter('avatar_directory'), $fileNameTwo);

            $shop->setShopImage($fileNameOne);
            $shop->setLogo($fileNameTwo);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shop_edit', ['id' => $shop->getId()]);
        }

        return $this->render('shop/edit.html.twig', [
                    'shop' => $shop,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shop_delete", methods="DELETE")
     */
    public function delete(Request $request, Shop $shop): Response {
        if ($this->isCsrfTokenValid('delete' . $shop->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($shop);
            $em->flush();
        }

        return $this->redirectToRoute('shop_index');
    }

    /**
     * @return string
     */
    private function generateFileName() {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
   

}
