<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer le commentaire dans la base de données
            $entityManager->persist($commentaire);
            $entityManager->flush();
            // Rediriger ou afficher un message de succès
            $this->addFlash('success', 'Votre commentaire a été ajouté avec succès !');
            return $this->redirectToRoute('app_home');
        }
        // Récupérer les commentaires de la base de données
        $commentaires = $entityManager->getRepository(Commentaire::class)->findBy(['status' => true]);
        // Si aucun commentaire n'est trouvé, on peut rediriger ou afficher un message
        if (empty($commentaires)) {
            $this->addFlash('info', 'Il n\'y a pas encore de commentaires. Soyez le premier à en laisser un !');
        }
        return $this->render('home/index.html.twig', [
            'commentaires' => $commentaires,
            'form' => $form
        ]);
    }
}
