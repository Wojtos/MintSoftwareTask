<?php


namespace App\Controller;



use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    const PER_PAGE = 10;
    const FLUSH_TYPE = 'switch_enabling';
    private UserRepository $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @Route("/list", name="app_user_list")
     */
    public function paginatedList(Request $request, PaginatorInterface $paginator): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $pagination = $paginator->paginate(
            $this->userRepository->createFindAllQuery(),
            $request->query->getInt('page', 1),
            self::PER_PAGE
        );

        return $this->render('user/list.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/switch-enabling/{userId}", name="app_user_switch_enabling")
     */
    public function switchEnabling(int $userId, Request $request): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->userRepository->find($userId);
        if ($user) {
            $user->setEnabled(!$user->getEnabled());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash(self::FLUSH_TYPE, 'User ' . ($user->getEnabled() ? 'enabled' : 'disabled'));
        } else {
            $this->addFlash(self::FLUSH_TYPE, 'User not found');
        }
        return new RedirectResponse($this->generateUrl(
            'app_user_list',
            ['page' => $request->query->getInt('page', 1), ]
        ));
    }
}