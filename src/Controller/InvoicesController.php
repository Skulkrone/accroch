<?php

namespace App\Controller;

use App\Entity\Invoices;
use App\Form\InvoicesType;
use App\Repository\InvoicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/invoices")
 */
class InvoicesController extends Controller
{
    /**
     * @Route("/", name="invoices_index", methods="GET")
     */
    public function index(InvoicesRepository $invoicesRepository): Response
    {
        return $this->render('invoices/index.html.twig', ['invoices' => $invoicesRepository->findAll()]);
    }

    /**
     * @Route("/new", name="invoices_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $invoice = new Invoices();
        $form = $this->createForm(InvoicesType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush();

            return $this->redirectToRoute('invoices_index');
        }

        return $this->render('invoices/new.html.twig', [
            'invoice' => $invoice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="invoices_show", methods="GET")
     */
    public function show(Invoices $invoice): Response
    {
        return $this->render('invoices/show.html.twig', ['invoice' => $invoice]);
    }

    /**
     * @Route("/{id}/edit", name="invoices_edit", methods="GET|POST")
     */
    public function edit(Request $request, Invoices $invoice): Response
    {
        $form = $this->createForm(InvoicesType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invoices_edit', ['id' => $invoice->getId()]);
        }

        return $this->render('invoices/edit.html.twig', [
            'invoice' => $invoice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="invoices_delete", methods="DELETE")
     */
    public function delete(Request $request, Invoices $invoice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invoice->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invoice);
            $em->flush();
        }

        return $this->redirectToRoute('invoices_index');
    }
}
