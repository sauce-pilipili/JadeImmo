<?php

namespace App\Controller;

use App\Entity\AnnoncesSearch;
use App\Form\AnnoncesSearchType;
use App\Repository\AnnoncesRepository;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(Request $request, AnnoncesRepository $annoncesRepository): Response
    {

        if ($request->isXmlHttpRequest()) {
            $loctableau = [];
            $localisation = $annoncesRepository->findLocalisation();
            foreach ($localisation as $loc) {
                array_push($loctableau, $loc['localisation']);
            }
            return new JsonResponse([
                'loc' => $loctableau
            ]);
        }

        if ($request->isMethod('post')) {
//            dd( $request->get('localisation'),
//                $request->get('typeDeBien'),
//                $request->get('surfaceMin'),
//                $request->get('prixMax'),
//                $request->get('chambre'),
//                $request->get('piece'),
//                $request->get('surfaceBienMax'),
//                $request->get('surfaceBienMin'),
//                $request->get('surfaceTerrainMin'),
//                $request->get('surfaceTerrainMax'),
//                $request->get('piscine'),
//                $request->get('terrasse'),
//                $request->get('balcon'),
//                $request->get('jardin'),
//                $request->get('cave'),
//                $request->get('parking'));
            return $this->redirectToRoute('achat', [
                'fromForm' => 'form',
                'localisation'=> $request->get('localisation'),
                'typeDeBien'=>$request->get('typeDeBien'),
                'surfaceMin'=>$request->get('surfaceMin'),
                'prixMax'=>$request->get('prixMax'),
                'chambre'=>$request->get('chambre'),
                'piece'=>$request->get('piece'),
                'surfaceBienMax'=>$request->get('surfacebienMax'),
                'surfaceBienMin'=>$request->get('surfaceBienMin'),
                'surfaceTerrainMin'=>$request->get('surfaceTerrainMin'),
                'surfaceTerrainMax'=>$request->get('surfaceTerrainMax'),
                'piscine'=>$request->get('piscine'),
                'terrasse'=>$request->get('terrasse'),
                'balcon'=>$request->get('balcon'),
                'jardin'=>$request->get('jardin'),
                'cave'=>$request->get('cave'),
                'parking'=>$request->get('parking',)
            ]);

        }

        $coupDeCoeur = $annoncesRepository->findCoupDeCoeur();
        $annonces = $annoncesRepository->findAllAnonces();
        return $this->render('main/index.html.twig', [
            'annonces' => $annonces,
            'coupDeCoeur' => $coupDeCoeur,
        ]);
    }

    /**
     * @Route("/achat", name="achat")
     */
    public function achat(Request $request, AnnoncesRepository $annoncesRepository): Response
    {
        $annonces = $annoncesRepository->findAllAnonces();
        if ($request->isMethod('post')){
            $annonces = $annoncesRepository->findAnnoncesByFormulaire(
                $request->get('localisation'),
                $request->get('typeDeBien'),
                $request->get('surfaceMin'),
                $request->get('prixMax'),
                $request->get('chambre'),
                $request->get('piece'),
                $request->get('surfaceBienMax'),
                $request->get('surfaceBienMin'),
                $request->get('surfaceTerrainMin'),
                $request->get('surfaceTerrainMax'),
                $request->get('piscine'),
                $request->get('terrasse'),
                $request->get('balcon'),
                $request->get('jardin'),
                $request->get('cave'),
                $request->get('parking')
            );
        }
        if ($request->get('fromForm') != null ) {
            $annonces = $annoncesRepository->findAnnoncesByFormulaire(
                $request->get('localisation'),
                $request->get('typeDeBien'),
                $request->get('surfaceMin'),
                $request->get('prixMax'),
                $request->get('chambre'),
                $request->get('piece'),
                $request->get('surfaceBienMax'),
                $request->get('surfaceBienMin'),
                $request->get('surfaceTerrainMin'),
                $request->get('surfaceTerrainMax'),
                $request->get('piscine'),
                $request->get('terrasse'),
                $request->get('balcon'),
                $request->get('jardin'),
                $request->get('cave'),
                $request->get('parking')
            );
        }

        $coupDeCoeur = $annoncesRepository->findCoupDeCoeur();
        return $this->render('main/achat.html.twig', [
            'coupDeCoeur' => $coupDeCoeur,
            'annonces' => $annonces,
        ]);

    }

    /**
     * @Route("/vendre", name="vendre")
     */
    public function vendre(Request $request, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $bien = null;
            if ($request->get('appartement') == true) {
                $bien = 'appartement';
            }
            if ($request->get('villa') == true) {
                $bien = 'villa';
            }
            if ($request->get('chateau') == true) {
                $bien = 'chateau';
            }
            if ($request->get('immeuble') == true) {
                $bien = 'immeuble';
            }
            if ($request->get('bureaux') == true) {
                $bien = 'bureaux';
            }
            $emailContact = (new Email())
                ->from($request->get('email'))
                ->to('admin@mail.fr')
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Une nouvel demande de devis de vente')
                ->text(
                    'Le client: ' .
                    $request->get('name') . ', numéro: ' .
                    $request->get('tel') . ' a une demande pour une vente: ' .
                    $bien . ' disponibilité du bien le: ' .
                    $request->get('trip-start') . ' d\'une surface de: ' .
                    $request->get('surface') . ', adresse: ' .
                    $request->get('adress') . ', codepostal: ' .
                    $request->get('code') . ', ville: ' .
                    $request->get('ville') . ', decscritpion:  ' .
                    $request->get('description') . '.'
                );
            try {
                $mailer->send($emailContact);
                $this->addFlash('success', 'Votre message a bien été envoyé');
                return $this->redirectToRoute('contact');
            } catch (ExceptionInterface $exception) {
                $this->addFlash('danger', 'l\'adresse email renseigné n\'est pas valable');
                return $this->redirectToRoute('contact');
            }
        }

        return $this->render('main/vendre.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/agence", name="agence")
     */
    public function agence(Request $request, AnnoncesRepository $annoncesRepository): Response
    {
        $coupDeCoeur = $annoncesRepository->findCoupDeCoeur();
        return $this->render('main/agence.html.twig', [
            'coupDeCoeur' => $coupDeCoeur,
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST') && $request->get('consentement') == true) {
            $emailContact = (new Email())
                ->from($request->get('email'))
                ->to('admin@mail.fr')
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Une nouvel demande de contact')
                ->text('Le client: ' . $request->get('name') . ', numéro: ' . $request->get('tel') . ' a un message pour vous: ' . $request->get('description'));
            try {
                $mailer->send($emailContact);
                $this->addFlash('success', 'Votre message a bien été envoyé');
                return $this->redirectToRoute('contact');
            } catch (ExceptionInterface $exception) {
                $this->addFlash('danger', 'l\'adresse email renseigné n\'est pas valable');
                return $this->redirectToRoute('contact');
            }
        }
        return $this->render('main/contact.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/legal", name="legal")
     */
    public function legal(): Response
    {
        return $this->render('main/legal.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/actualite", name="actualite")
     */
    public function actualite(Request $request, ArticlesRepository $articlesRepository, AnnoncesRepository $annoncesRepository): Response
    {
        $coupDeCoeur = $annoncesRepository->findCoupDeCoeur();
        $articles = $articlesRepository->findAll();
        return $this->render('main/actualite.html.twig', [
            'articles' => $articles,
            'coupDeCoeur' => $coupDeCoeur
        ]);
    }

    /**
     * @Route("/actu/{slug}", name="actu_show")
     */
    public function actuShow(Request $request, $slug, ArticlesRepository $articlesRepository): Response
    {
        $article = $articlesRepository->findOneBy(['slug'=>$slug]);
        $articleSimilaire = $articlesRepository->findSimilaire($article->getCategorie());
        return $this->render('main/actuShow.html.twig', [
            'article' => $article,
            'articleSimilaire' => $articleSimilaire,
        ]);
    }

    /**
     * @Route("/presentation{id}", name="presentation")
     */
    public function presentationBien($id, Request $request, AnnoncesRepository $annoncesRepository): Response
    {

        $annonce = $annoncesRepository->find($id);
        return $this->render('main/presentationBien.html.twig', [
            'annonce' => $annonce,
        ]);
    }
}
