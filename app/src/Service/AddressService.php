<?php
/**
 * Address service.
 */

namespace App\Service;

use App\Entity\Address;
use App\Repository\AddressRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class AddressService.
 */
class AddressService implements AddressServiceInterface
{
    /**
     * Address repository.
     */
    private AddressRepository $addressRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param AddressRepository  $addressRepository Address repository
     * @param PaginatorInterface $paginator         Paginator
     */
    public function __construct(AddressRepository $addressRepository, PaginatorInterface $paginator)
    {
        $this->addressRepository = $addressRepository;
        $this->paginator = $paginator;
    }

    /**
     * Get paginated list.
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->addressRepository->queryAll(),
            $page,
            AddressRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Address $address Address entity
     */
    public function save(Address $address): void
    {
        $this->addressRepository->save($address);
    }

    /**
     * Delete entity.
     *
     * @param Address $address Address entity
     */
    public function delete(Address $address): void
    {
        $this->addressRepository->delete($address);
    }
}
