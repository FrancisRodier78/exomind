<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use App\Entity\Car;
use App\Entity\Job;
use App\Entity\User;
use App\Entity\Estate;
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
        for ($i=0; $i < 12; $i++) { 
            $ad = new Ad;
            $user = $users[mt_rand(0, count($users) - 1)];

            $title = $faker->sentence(3);
            $content = $faker->sentence(7);

            $ad->setTitle($title)
               ->setContent($content)
               ->setRelation($user);

            $cat = mt_rand(1, 3);

            // Initialisation des attribues employées
            switch ($cat) {
                case 1:
                    $job = new Job;

                    $job->setSalary(mt_rand(10, 30))
                        ->setContract('CDI')
                        ->setRelation($ad);

                    $manager->persist($job);

                    break;
                case 2:
                    $car = new Car;
                    
                    $car->setFuel('gasoil')
                        ->setPrice(mt_rand(1000, 4000))
                        ->setRelation($ad);

                    $manager->persist($car);

                    break;
                case 3:
                    $estate = new Estate;

                    $estate->setArea(mt_rand(60, 90))
                           ->setPrice(mt_rand(10000, 20000))
                           ->setRelation($ad);

                    $manager->persist($estate);

                    break;
            }

            $manager->persist($ad);
        }

        $manager->flush();
    }
}
