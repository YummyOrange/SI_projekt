<?php
/**
 * Link controller.
 */

namespace App\Controller;

use App\Repository\AddressRepository;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *Class LinkController.
 */
#[Route('/link')]
class LinkController extends AbstractController
{
    /**
     * Address repository.
     */
    private AddressRepository $addressRepository;

    /**
     * Link index.
     *
     * @param string            $out               Address out
     * @param AddressRepository $addressRepository Address Repo
     *
     * @return Response Response
     */
    #[NoReturn] #[Route(
        '/{out}',
        name: 'link_index',
        requirements: ['out' => '[0-9]+'],
        defaults: ['out' => '0'],
        methods: 'GET'
    )]
    public function index(string $out, AddressRepository $addressRepository): Response
    {
        $this->addressRepository = $addressRepository;
        $record = $this->addressRepository->findOneBy(['addressOut' => $out]);
        $address = $record->getAddressIn();
        $record->setClickCounter($record->getClickCounter() + 1);
        $addressRepository->save($record);
        if (str_starts_with($address, 'https://') || str_starts_with($address, 'http://')) {
            $link = $address;
        } else {
            $link = 'https://'.$address;
        }

        return $this->redirect($link);
    }
}
