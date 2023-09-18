<?php
/**
 * Address service interface.
 */

namespace App\Service;

use App\Entity\Address;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface AddressServiceInterface.
 */
interface AddressServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface;

    /**
     * Save entity.
     *
     * @param Address $address Address entity
     */
    public function save(Address $address): void;

    /**
     * Delete entity.
     *
     * @param Address $address Address entity
     */
    public function delete(Address $address): void;
}
