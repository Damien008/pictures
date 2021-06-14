<?php

namespace App\DataFixtures;

use App\Entity\Blogpost;
use App\Entity\Categorie;
use App\Entity\Peinture;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @codeCoverageIgnore
 */
class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $user = new User();

        $user->setEmail('admin@monsite.com')
             ->setPrenom($faker->firstName())
             ->setNom($faker->lastName())
             ->setTelephone($faker->phoneNumber())
             ->setAPropos($faker->text())
             ->setInstagram('instagram')
             ->setRoles(['ROLE_PEINTRE']);
        
        $password = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $blogpost = new Blogpost();

            $blogpost->setTitre($faker->words(3, true))
                     ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                     ->setContenu($faker->text(350))
                     ->setSlug($faker->slug(3))
                     ->setUser($user);
            
            $manager->persist($blogpost);
        }

        // création blogpost de test

        $blogpost = new Blogpost();

            $blogpost->setTitre('Blogpost test')
                     ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                     ->setContenu($faker->text(350))
                     ->setSlug('Blogpost-test')
                     ->setUser($user);
                     
            $manager->persist($blogpost);

        for ($k = 0; $k < 5; $k++) {
            $categorie = new Categorie();

            $categorie->setNom($faker->word())
                      ->setDescription($faker->words(10, true))
                      ->setSlug($faker->slug());

            $manager->persist($categorie);

            for ($j = 0; $j < 2; $j++) {
                $peinture = new Peinture();
    
                $peinture->setNom($faker->word(3, true))
                         ->setLargeur($faker->randomFloat(2, 20, 60))
                         ->setHauteur($faker->randomFloat(2, 20, 60))
                         ->setEnVente($faker->randomElement([true, false]))
                         ->setDateRealisation($faker->dateTimeBetween('-6 month', 'now'))
                         ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                         ->setDescription($faker->text())
                         ->setPortfolio($faker->randomElement([true, false]))
                         ->setSlug($faker->slug())
                         ->setFile('captain.jpg')
                         ->addCategorie($categorie)
                         ->setPrix($faker->randomFloat(2, 100, 9999))
                         ->setUser($user);
    
                $manager->persist($peinture);
            }
        }

        // création catégorie pour test

        $categorie = new Categorie();

            $categorie->setNom('catégorie test')
                      ->setDescription($faker->words(10, true))
                      ->setSlug('catégorie-test');

            $manager->persist($categorie);

        // création peinture pour test

        $peinture = new Peinture();
    
                $peinture->setNom('peinture test')
                         ->setLargeur($faker->randomFloat(2, 20, 60))
                         ->setHauteur($faker->randomFloat(2, 20, 60))
                         ->setEnVente($faker->randomElement([true, false]))
                         ->setDateRealisation($faker->dateTimeBetween('-6 month', 'now'))
                         ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                         ->setDescription($faker->text())
                         ->setPortfolio($faker->randomElement([true, false]))
                         ->setSlug('peinture-test')
                         ->setFile('captain.jpg')
                         ->addCategorie($categorie)
                         ->setPrix($faker->randomFloat(2, 100, 9999))
                         ->setUser($user);
    
                $manager->persist($peinture);

        
        $manager->flush();
    }
}
