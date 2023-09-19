<?php
/**
 * Address fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\AnonUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

/**
 * Class AddressFixtures.
 */
class AddressFixtures extends Fixture
{
    /**
     * Faker.
     */
    protected Generator $faker;

    /**
     * Persistence object manager.
     */
    protected ObjectManager $manager;

    /**
     * Load.
     *
     * @param ObjectManager $manager Persistence object manager
     */
    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        for ($i = 0; $i < 10; ++$i) {
            $address = new Address();
            $address->setAddressIn($this->faker->sentence);
            $address->setAddressOut($this->faker->randomNumber(4));
            $address->setClickCounter($this->faker->numerify);
            $anonUser = new AnonUser();
            $anonUser->setAnonUserEmail('anon@example.com');
            $address->setAnonUser($anonUser);
            $address->setAddDate(
                \DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', '-1 days'))
            );
            $manager->persist($address);
            $manager->persist($anonUser);
        }

        $manager->flush();
    }
}
