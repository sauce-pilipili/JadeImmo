<?php

namespace App\Controller;

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
        $coupDeCoeur = $annoncesRepository->findCoupDeCoeur();
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
            $annonces = $annoncesRepository->findAnnoncesByFormulaire(
                $this->test($request->get('localisation')),
                $this->test($request->get('typeDeBien')),
                $this->test($request->get('surfaceMin')),
                $this->test($request->get('prixMax')),
                $this->test($request->get('chambre')),
                $this->test($request->get('piece')),
                $this->test($request->get('surfaceBienMax')),
                $this->test($request->get('surfaceBienMin')),
                $this->test($request->get('surfaceTerrainMin')),
                $this->test($request->get('surfaceTerrainMax')),
                $this->test($request->get('piscine')),
                $this->test($request->get('terrasse')),
                $this->test($request->get('balcon')),
                $this->test($request->get('jardin')),
                $this->test($request->get('cave')),
                $this->test($request->get('parking'))
            );

            return $this->render('main/achat.html.twig', [
                'coupDeCoeur' => $coupDeCoeur,
                'annonces' => $annonces,
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
     * @Route("/achat/", name="achat")
     */
    public function achat(Request $request, AnnoncesRepository $annoncesRepository): Response
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
        $annonces = $annoncesRepository->findAllAnonces();
        if ($request->isMethod('post')) {
            $annonces = $annoncesRepository->findAnnoncesByFormulaire(
                $this->test($request->get('localisation')),
                $this->test($request->get('typeDeBien')),
                $this->test($request->get('surfaceMin')),
                $this->test($request->get('prixMax')),
                $this->test($request->get('chambre')),
                $this->test($request->get('piece')),
                $this->test($request->get('surfaceBienMax')),
                $this->test($request->get('surfaceBienMin')),
                $this->test($request->get('surfaceTerrainMin')),
                $this->test($request->get('surfaceTerrainMax')),
                $this->test($request->get('piscine')),
                $this->test($request->get('terrasse')),
                $this->test($request->get('balcon')),
                $this->test($request->get('jardin')),
                $this->test($request->get('cave')),
                $this->test($request->get('parking'))
            );
        }
        $coupDeCoeur = $annoncesRepository->findCoupDeCoeur();
        return $this->render('main/achat.html.twig', [
            'coupDeCoeur' => $coupDeCoeur,
            'annonces' => $annonces,
        ]);

    }

    /**
     * @Route("/neuf/", name="neuf")
     */
    public function neuf(Request $request, AnnoncesRepository $annoncesRepository): Response
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
        $annonces = $annoncesRepository->findAllAnoncesNeuf();
        if ($request->isMethod('post')) {
            $annonces = $annoncesRepository->findAnnoncesNeuf(
                $this->test($request->get('localisation')),
                $this->test($request->get('surfaceMin')),
                $this->test($request->get('prixMax')),
                $this->test($request->get('chambre')),
                $this->test($request->get('piece')),
                $this->test($request->get('surfaceBienMax')),
                $this->test($request->get('surfaceBienMin')),
                $this->test($request->get('surfaceTerrainMin')),
                $this->test($request->get('surfaceTerrainMax')),
                $this->test($request->get('piscine')),
                $this->test($request->get('terrasse')),
                $this->test($request->get('balcon')),
                $this->test($request->get('jardin')),
                $this->test($request->get('cave')),
                $this->test($request->get('parking'))
            );
        }
        $coupDeCoeur = $annoncesRepository->findCoupDeCoeur();
        return $this->render('main/neuf.html.twig', [
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
            if ($this->test($request->get('appartement')) == true) {
                $bien = 'appartement';
            }
            if ($this->test($request->get('villa')) == true) {
                $bien = 'villa';
            }
            if ($this->test($request->get('chateau')) == true) {
                $bien = 'chateau';
            }
            if ($this->test($request->get('immeuble')) == true) {
                $bien = 'immeuble';
            }
            if ($this->test($request->get('bureaux')) == true) {
                $bien = 'bureaux';
            }
            $emailContact = (new Email())
                ->from($this->test($request->get('email')))
                ->to('contact@jade-immobilier.fr')
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Une nouvel demande de devis de vente')
                ->text(
                    'Le client: ' .
                    $this->test($request->get('name')) . ', numéro: ' .
                    $this->test($request->get('tel')) . ' a une demande pour une vente: ' .
                    $bien . ' disponibilité du bien le: ' .
                    $this->test($request->get('trip-start')) . ' d\'une surface de: ' .
                    $this->test($request->get('surface')) . ', adresse: ' .
                    $this->test($request->get('adress')) . ', codepostal: ' .
                    $this->test($request->get('code')) . ', ville: ' .
                    $this->test($request->get('ville')) . ', decscritpion:  ' .
                    $this->test($request->get('description')) . '.'
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
    public function contact(Request $request, MailerInterface $mailer, AnnoncesRepository $annoncesRepository): Response
    {
        if ($request->get('info') != null) {
            $annonce = $annoncesRepository->find($request->get('info'));

        }
        if ($request->isMethod('POST') && $request->get('consentement') == true) {
            $subject = '';
            if ($request->get('info') != null) {
                $subject = 'Une nouvel demande de contact pour:' . $annonce->getTitle() . ' à ' . $annonce->getLocalisation();
            } else {
                $subject = 'Une nouvel demande de contact';
            }


            $emailContact = (new Email())
                ->from($request->get('email'))
                ->to('contact@jade-immobilier.fr')
                ->priority(Email::PRIORITY_HIGH)
                ->subject($subject)
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
        $article = $articlesRepository->findOneBy(['slug' => $slug]);
        $articleSimilaire = $articlesRepository->findSimilaire($article->getCategorie());
        return $this->render('main/actuShow.html.twig', [
            'article' => $article,
            'articleSimilaire' => $articleSimilaire,
        ]);
    }

    /**
     * @Route("/presentation{slug}", name="presentation")
     */
    public function presentationBien($slug, Request $request, AnnoncesRepository $annoncesRepository): Response
    {
        $annonce = $annoncesRepository->findOneBy(['slug' => $slug]);
        return $this->render('main/presentationBien.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    function test($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
