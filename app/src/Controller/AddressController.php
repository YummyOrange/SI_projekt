<?php
/**
 * Address controller.
 */

namespace App\Controller;

use App\Entity\Address;
use App\Service\AddressServiceInterface;
use App\Form\Type\AddressType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class AddressController.
 */
#[Route('/address')]
class AddressController extends AbstractController
{
    /**
     * Address service.
     */
    private AddressServiceInterface $addressService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    /**
     * Constructor.
     *
     * @param AddressServiceInterface $addressService Address service
     * @param TranslatorInterface     $translator     Translator
     */
    public function __construct(AddressServiceInterface $addressService, TranslatorInterface $translator)
    {
        $this->addressService = $addressService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request HTTP Request
     *
     * @return Response HTTP response
     */
    #[Route(name: 'address_index', methods: 'GET')]
    public function index(Request $request): Response
    {
        $pagination = $this->addressService->getPaginatedList(
            $request->query->getInt('page', 1),
        );

        return $this->render('address/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Address $address Address entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}', name: 'address_show', requirements: ['id' => '[1-9]\d*'], methods: 'GET', )]
    public function show(Address $address): Response
    {
        return $this->render('address/show.html.twig', ['address' => $address]);
    }

    /**
     * Create action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     */
    #[Route('/create', name: 'address_create', methods: 'GET|POST')]
    public function create(Request $request): Response
    {
        /** @var User $user */
        $address = new Address();
        $form = $this->createForm(
            AddressType::class,
            $address,
            ['action' => $this->generateUrl('address_create')]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $address->setAddressOut('chuj');
            $address->setAddDate(new \DateTime('now'));
            $address->setClickCounter(0);
            $this->addressService->save($address);

            $this->addFlash(
                'success',
                $this->translator->trans('message.created_successfully')
            );

            return $this->redirectToRoute('address_index');
        }

        return $this->render(
            'address/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param Request $request HTTP request
     * @param Address $address Address entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/edit', name: 'address_edit', requirements: ['id' => '[1-9]\d*'], methods: 'GET|PUT')]
    public function edit(Request $request, Address $address): Response
    {
        $form = $this->createForm(
            AddressType::class,
            $address,
            [
                'method' => 'PUT',
                'action' => $this->generateUrl('address_edit', ['id' => $address->getId()]),
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addressService->save($address);

            $this->addFlash(
                'success',
                $this->translator->trans('message.edited_successfully')
            );

            return $this->redirectToRoute('address_index');
        }

        return $this->render(
            'address/edit.html.twig',
            [
                'form' => $form->createView(),
                'address' => $address,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Request $request HTTP request
     * @param Address $address Address entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/delete', name: 'address_delete', requirements: ['id' => '[1-9]\d*'], methods: 'GET|DELETE')]
    public function delete(Request $request, Address $address): Response
    {
        $form = $this->createForm(
            FormType::class,
            $address,
            [
                'method' => 'DELETE',
                'action' => $this->generateUrl('address_delete', ['id' => $address->getId()]),
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addressService->delete($address);

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('address_index');
        }

        return $this->render(
            'address/delete.html.twig',
            [
                'form' => $form->createView(),
                'address' => $address,
            ]
        );
    }
}
