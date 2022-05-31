<?php
// src/Controller/HelloController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends AbstractController {
    #[Route('/hello/{name}', name: 'hello')]
    public function indexAction($name): Response
    {
        return new Response('<html lang="fr"><body>Hello ' . $name . '!</body></html>');
    }
}
