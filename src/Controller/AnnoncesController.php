<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnoncesType;
use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/annonces")
 */
class AnnoncesController extends AbstractController
{
    /**
     * @Route("/", name="annonces_index", methods={"GET"})
     */
    public function index(AnnoncesRepository $annoncesRepository): Response
    {
        return $this->render('annonces/index.html.twig', [
            'annonces' => $annoncesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="annonces_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $annonce = new Annonces();
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            if ($form->get('photoEnAvant')->getData() != null) {
                $image = $form->get('photoEnAvant')->getData();
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                $img = new Photos();
                $img->setName($fichier);
                $annonce->setPhotoEnAvant($img);
            }


            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('annonces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonces/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="annonces_show", methods={"GET"})
     */
    public function show(Annonces $annonce): Response
    {
        return $this->render('annonces/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="annonces_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Annonces $annonce): Response
    {
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annonces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonces/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="annonces_delete", methods={"POST"})
     */
    public function delete(Request $request, Annonces $annonce): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($annonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('annonces_index', [], Response::HTTP_SEE_OTHER);
    }
}
