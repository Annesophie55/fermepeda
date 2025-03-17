<?php

namespace App\Controller;

use App\Repository\PageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PageController extends AbstractController
{
    #[Route('/page/{slug}', name: 'page_show')]
    public function show(PageRepository $pageRepository, string $slug): Response
    {
        $page = $pageRepository->findOneBy(['slug' => $slug]);
    
        if (!$page) {
            throw $this->createNotFoundException('Cette page n’existe pas.');
        }
    
        return $this->render('page/show.html.twig', [
            'page' => $page,
        ]);
    }
    
}
