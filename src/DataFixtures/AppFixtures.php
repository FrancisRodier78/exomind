<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $users = [];

        //Gestion of user
        for ($i=0; $i < 3; $i++) { 
            $user = new User();
            $hash = $this->encoder->encodePassword($user, 'password');

            $user->setEmail($faker->email)
                 ->setPassword($hash)
                 ->setName($faker->lastname)
                 ->setFirstName($faker->lastname);

            $manager->persist($user);
            $users[] = $user;
        }

        // Gestion of ad
        for ($i=0; $i < 10; $i++) { 
            $ad = new Ad;
            $user = $users[mt_rand(0, count($users) - 1)];

            $title = $faker->sentence(3);
            $content = $faker->sentence(7);
            $category = mt_rand(1, 3);

            $ad->setTitle($title)
                 ->setContent($content)
                 ->setCategory($category)
                 ->setRelation($user);

            // Initialisation à blanc des attribues non employées
            $ad->setSalary(0)
                ->setContract('')
                ->setFuelType('')
                ->setCarPrice(0)
                ->setArea(0)
                ->setAccomPrice(0);

            // Initialisation des attribues employées
            switch ($category) {
                case 1:
                    $ad->setSalary(mt_rand(10, 30))
                       ->setContract('CDI');
                    break;
                case 2:
                    $ad->setFuelType('gasoil')
                       ->setCarPrice(mt_rand(1, 4));
                    break;
                case 3:
                    $ad->setArea(mt_rand(60, 90))
                       ->setAccomPrice(mt_rand(1000, 2000));
                    break;
            }

            $manager->persist($ad);
        }

        $manager->flush();
    }
}
