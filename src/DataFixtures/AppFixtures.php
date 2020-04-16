<?php

namespace App\DataFixtures;


use App\Entity\Tache;
use Faker\Factory;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       
 $faker = Factory::create('FR-fr');
          for($i = 1; $i <= 10; $i++){
     $tasks = new Tache();
      $title = $faker->sentence();
      $categorie = $faker->sentence();
      
      $Introduction = $faker->paragraph(2);
      $heure = $faker->dateTime();
     
     $tasks->setTitre($title) 
           ->setDescription($Introduction)
           ->setCategorie( $categorie)
           ->setBudget(mt_rand(40, 200))
           ->setHeureDatePublication($heure);
      
       

         
        


      $manager->persist($tasks);
    }
        $manager->flush();
    }
}
