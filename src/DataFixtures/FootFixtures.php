<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\FootEquipement;

class FootFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

      /*  for($i = 1; $i <= 10; $i++){
            $footEquipement  = new FootEquipement();
            $footEquipement->setName("oumy n°$i")
                           ->setMarque("$i Addidas")
                           ->setPrix("12")
                           ->setDescription("nanani nanana")
                           ->setQualite("Trés bonne");

                           $manager->persist($footEquipement);*/
    
                           
        }
    
        

      
    }

