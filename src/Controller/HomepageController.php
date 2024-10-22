<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        return $this->render('homepage.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
