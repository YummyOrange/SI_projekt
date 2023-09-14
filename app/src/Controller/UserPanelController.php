<?php
/**
 * Hello controller.
 */

namespace App\Controller;

use App\Form\Type\PasswordChangeType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 *Class HelloController.
 */
#[Route('/panel')]
#[IsGranted('ROLE_USER')]
class UserPanelController extends AbstractController
{
    private Security $security;

    private UserPasswordHasherInterface $passwordHasher;

    private UserRepository $userRepository;

    private TranslatorInterface $translator;

    public function __construct(Security $security, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository, TranslatorInterface $translator)
    {
        $this->security = $security;
        $this->passwordHasher = $passwordHasher;
        $this->userRepository = $userRepository;
        $this->translator = $translator;
    }

    #[Route(
        '/password',
        name: 'change_password',
        methods: ['GET', 'POST']
    )]
    public function changePassword(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(
            PasswordChangeType::class,
            $user,
            ['action' => $this->generateUrl('change_password')]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (strcmp($form['password']->getData(), 0 === $user->getPassword())) {
                $newPassword = $this->passwordHasher->hashPassword($user, $form['new_password']->getData());
                $user->setPassword($newPassword);
                $this->userRepository->save($user, true);
                $this->addFlash(
                    'success',
                    $this->translator->trans('message.edited_successfully')
                );
            } else {
                $this->addFlash(
                    'warning',
                    $this->translator->trans('message.error')
                );
            }
            exit();
            return $this->redirectToRoute('address_index');
        }

        return $this->render(
            'panel/index.html.twig',
            ['form' => $form->createView()]
        );
    }
}
