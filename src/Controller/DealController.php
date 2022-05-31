<?php

namespace App\Controller;

use App\Entity\Deal;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DealController extends AbstractController
{
    #[Route('/deal/list', name: 'deal_list', methods: ['GET'])]
    #[Route('/', name: 'homepage', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('deal/index.html.twig', [
            'controller_name' => 'DealController',
        ]);
    }

    #[Route('/deal/show/{index}', name: 'deal_show', requirements: ['index' => '\d+'], methods: ['GET'])]
    public function show(int $index): Response
    {
        return $this->render('deal/show.html.twig', [
            'controller_name' => 'DealController',
            'index' => $index
        ]);
    }

    #[Route('deal/toggle/{index}', name: 'deal_toggle', methods: ['GET'])]
    public function toggleEnableAction(ManagerRegistry $doctrine, int $index): Response
    {
        $entityManager = $doctrine->getManager();

        $deal = $entityManager->getRepository(Deal::class)->find($index);
        if (!$deal) {
            throw $this->createNotFoundException("No deal found for id {$index}");
        }

        $deal->setEnable(!$deal->isEnable());
        $entityManager->flush();

        return $this->render('deal/toggle.html.twig', [
            'controller_name' => 'DealController',
            'index' => $index,
            'deal' => $deal
        ]);
    }

    #[Route('deal/list', name: 'deal_list', methods: ['GET'])]
    public function listAction(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $deals = $entityManager->getRepository(Deal::class)->findAllEnableOrderByDate();

        return $this->render('deal/list.html.twig', [
            'controller_name' => 'DealController',
            'deals' => $deals
        ]);
    }
}
