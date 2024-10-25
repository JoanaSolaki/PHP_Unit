<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use App\Service\LimitChecker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage', methods: ['GET', 'POST'])]
    public function index(EntityManagerInterface $entityManager, Request $request, UserRepository $userRepository, LimitChecker $limitChecker): Response {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        $remainingSpots = $limitChecker->getRemainingSpots();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($limitChecker->isLimitReached()) {
                $this->addFlash('error', 'Le nombre maximum de 100 inscriptions a déjà été atteint.');
            } else {
                $existingUser = $userRepository->findOneBy(['email' => $user->getEmail()]);
                if ($existingUser) {
                    $this->addFlash('error', 'Cet email est déjà utilisé pour une inscription.');
                } else {
                    $entityManager->persist($user);
                    $entityManager->flush();
                    $this->addFlash('success', 'Votre inscription a bien été prise en compte !');
                    return $this->redirectToRoute('app_homepage');
                }
            }
        }

        return $this->render('homepage.html.twig', [
            'user' => $user,
            'registrationForm' => $form,
            'remainingSpots' => $remainingSpots,
        ]);
    }
}
