<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(Security $security, UrlGeneratorInterface $urlGenerator) {
        if ($security->isGranted('ROLE_USER')) {
            return new RedirectResponse($urlGenerator->generate('app_user_list'));
        } else {
            return new RedirectResponse($urlGenerator->generate('app_login'));
        }
    }
}