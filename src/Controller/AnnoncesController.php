<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Photos;
use App\Form\AnnoncesType;
use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function index(Request $request,AnnoncesRepository $annoncesRepository): Response
    {
        if ($request->isXmlHttpRequest()){
            $nom = $request->get('text');
            $annonces = $annoncesRepository->findajaxAnnonces($nom);
            return new JsonResponse([
                'content'=> $this->renderView('annonces/_contentAnnonces.html.twig',compact('annonces'))
            ]);
        }


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
//            photo en avant
            if ($form->get('ImageEnAvant')->getData() != null) {
                $image = $form->get('ImageEnAvant')->getData();
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                $annonce->setImageEnAvant($fichier);

            }
            if ($form->get('imageDuo')->getData() != null) {
                $imageduo = $form->get('imageDuo')->getData();
                foreach ($imageduo as $image) {
                    // On génère un nouveau nom de fichier
                    $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                    // On copie le fichier dans le dossier uploads
                    $image->move(
                        $this->getParameter('images_directory'),
                        $fichier
                    );
                    // On crée l'image dans la base de données
                    $imgDuo = new Photos();
                    $imgDuo->setName($fichier);
                    $annonce->addImagesDuo($imgDuo);

                }
            }
            if ($form->get('photosGalerie')->getData() != null) {
                $photosGalerie = $form->get('photosGalerie')->getData();
                foreach ($photosGalerie as $image) {
                    // On génère un nouveau nom de fichier
                    $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                    // On copie le fichier dans le dossier uploads
                    $image->move(
                        $this->getParameter('images_directory'),
                        $fichier
                    );
                    // On crée l'image dans la base de données
                    $imgGalerie = new Photos();
                    $imgGalerie->setName($fichier);
                    $annonce->addPhotosGalerie($imgGalerie);
                }
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

            if ($form->get('ImageEnAvant')->getData() != null) {
                $image = $form->get('ImageEnAvant')->getData();
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                $annonce->setImageEnAvant($fichier);

            }
            if ($form->get('imageDuo')->getData() != null) {
                $imageduo = $form->get('imageDuo')->getData();
                foreach ($imageduo as $image) {
                    // On génère un nouveau nom de fichier
                    $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                    // On copie le fichier dans le dossier uploads
                    $image->move(
                        $this->getParameter('images_directory'),
                        $fichier
                    );
                    // On crée l'image dans la base de données
                    $imgDuo = new Photos();
                    $imgDuo->setName($fichier);
                    $annonce->addImagesDuo($imgDuo);

                }
            }

            if ($form->get('photosGalerie')->getData() != null) {
                $photosGalerie = $form->get('photosGalerie')->getData();
                foreach ($photosGalerie as $image) {
                    // On génère un nouveau nom de fichier
                    $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                    // On copie le fichier dans le dossier uploads
                    $image->move(
                        $this->getParameter('images_directory'),
                        $fichier
                    );
                    // On crée l'image dans la base de données
                    $imgGalerie = new Photos();
                    $imgGalerie->setName($fichier);
                    $annonce->addPhotosGalerie($imgGalerie);
                }
            }
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

        $entityManager = $this->getDoctrine()->getManager();
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {

//            if ($annonce->getImagesDuo()!=null){
//                foreach ($annonce->getImagesDuo() as $img){
//                    unlink($this->getParameter('images_directory') . '/' . $img->getName());
//                    $entityManager->remove($img);
//                    $entityManager->flush();
//                }
//            }
//            if ($annonce->getPhotosGalerie()!=null){
//                foreach ($annonce->getPhotosGalerie() as $img){
//                    unlink($this->getParameter('images_directory') . '/' . $img->getName());
//                    $annonce->removePhotosGalerie($img);
//
//                }
//            }

            $entityManager->remove($annonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('annonces_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/supprime/photo/{id}", name="annonces_delete_image_duo", methods={"DELETE"})
     */
    public function deleteImage(Photos $image, Request $request,AnnoncesRepository $annoncesRepository)
    {
        $annonce = $annoncesRepository->find($image->getAnnoncesImagesDuo()->getId());
        $data = json_decode($request->getContent(), true);
        if ($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])) {
            // On récupère le nom de l'image
            $nom = $image->getName();
            $annonce->removeImagesDuo($image);
            // On supprime le fichier
            unlink($this->getParameter('images_directory') . '/' . $nom);
            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }

    /**
     * @Route("/supprime/galerie/{id}", name="annonces_delete_image_galerie", methods={"DELETE"})
     */
    public function deleteImageGalerie(Photos $image, Request $request, AnnoncesRepository $annoncesRepository)
    {
        $annonce = $annoncesRepository->find($image->getAnnoncesGalerie()->getId());

        $data = json_decode($request->getContent(), true);
        // On vérifie si le token est valide
        if ($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])) {
            // On récupère le nom de l'image
            $annonce->removePhotosGalerie($image);
            $nom = $image->getName();
            // On supprime le fichier
            unlink($this->getParameter('images_directory') . '/' . $nom);
            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }
}
