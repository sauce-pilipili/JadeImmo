<?php

namespace App\DataFixtures;

use App\Entity\Annonces;
use App\Entity\Photos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AnnoncesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $imagetab =['748a5ddfd85adb8e5f03f02fa451a6a3.jpg',
            '3459a6a8d67f403916f0c6b3d6251c3a.jpg',
            '8515e8155b1d23c019ce466e2a51249a.jpg'];

        $typedebien =['Villa',
            'Maison','Appartement','Terrain',
            'Propriété/Chateau','Immeuble',];
        $faker = Faker\Factory::create('fr_FR');
        $image = new Photos();
        $image->setName($imagetab[$faker->numberBetween(0,2)]);
        $manager->persist($image);
        $manager->flush();
        for ($nb = 1; $nb <= 80; $nb++) {

            $title = $faker->title;
            $annonces = new Annonces();
            $annonces->setTitle($title);
            $annonces->setMetaDescription($title);
            $annonces->setDescriptionDuBien($faker->realText(400));
            $annonces->setCoupDeCoeur(0);
            $annonces->setLocalisation($faker->city);
            $annonces->setImageEnAvant($image);
            for ($nb = 1; $nb <= 2; $nb++) {
                $annonces->addImagesDuo($image);
            }
            for ($nb = 1; $nb <= 10; $nb++) {
                $annonces->addPhotosGalerie($image);
            }
            $annonces->setTypeDeBien($typedebien[$faker->numberBetween(0,5)]);
            $annonces->setSurfaceHabitable($faker->numberBetween(120, 250));
            $annonces->setSurfaceDuTerrain($faker->numberBetween(400, 2000));
            $annonces->setNombreDeChambre($faker->numberBetween(1, 5));
            $annonces->setNombreDeSalleDeBain($faker->numberBetween(1, 3));
            $annonces->setNombreEtages($faker->numberBetween(0, 2));
            $annonces->setNombreDeToilettes($faker->numberBetween(1, 3));
            $annonces->setCheminee($faker->boolean(50));
            $annonces->setPiscine($faker->boolean(50));
            $annonces->setGarage($faker->boolean(50));
            $annonces->setBalcon($faker->boolean(50));
            $annonces->setParking($faker->boolean(50));
            $annonces->setJardin($faker->boolean(50));
            $annonces->setCave($faker->boolean(50));
            $annonces->setGardien($faker->boolean(50));
            $annonces->setTerrasse($faker->boolean(50));
            $annonces->setSystemDeSecurite($faker->text(30));
            $annonces->setPrixAvecHonoraires($faker->numberBetween(60000, 2500000));
            $annonces->setPrixSansHonoraires($faker->numberBetween(60000, 2500000));

             $manager->persist($annonces);


        }
        $manager->flush();
    }
}
