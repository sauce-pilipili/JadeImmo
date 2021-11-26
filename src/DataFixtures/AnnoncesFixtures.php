<?php

namespace App\DataFixtures;

use App\Entity\Annonces;
use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Photos;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AnnoncesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $user = new User();
        $user->setEmail('moishadow@gmail.com');
        $user->setPassword('$2y$13$374klUfKu4rr88oHrqGX7umYRcWmrtqpnNLeRbam.fZmfxRsXfeRe');
        $user->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);

        $categorieArticle = array();
        for ($i = 0; $i < 4; $i++) {
            $categorieArticle[$i] = new Categories();
            $categorieArticle[$i]->setName($faker->domainWord);
            $manager->persist($categorieArticle[$i]);
        }

        $articles = array();
        for ($i = 0; $i < 150; $i++) {
            $articles[$i] = new Articles();
            $articles[$i]->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true));
            $articles[$i]->setCreatedDate(new \DateTime('now'));
            $articles[$i]->setMetaDescription($faker->text(20));
            $articles[$i]->setCategorie($categorieArticle[$faker->numberBetween(0,3)]);
            $articles[$i]->setContent('
<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem 
Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like read
able English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum
&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (i
njected humour and the like).</p>');
            $articles[$i]->setImageEnAvant('5d68906adc11217cd0f4405ab53854ca.jpg');
            $manager->persist($articles[$i]);
        }



        $typedebien = ['Villa',
            'Maison', 'Appartement', 'Terrain',
            'Propriété/Chateau', 'Immeuble',];

        $villes =['Bordeaux','Bordeaux', 'Bordeaux','Libourne', 'Arcachon', 'Langon','Blanquefort','Canéjan','Camarsac', 'Begles', 'LeBouscat'];


        $image = new Photos();
        $image->setName('748a5ddfd85adb8e5f03f02fa451a6a3.jpg');
        $manager->persist($image);


        $annonces = [];
        for ($nb = 0; $nb <= 160; $nb++) {


            $annonces[$nb] = new Annonces();
            $annonces[$nb]->setTitle($faker->sentence($nbWords = 4));
            $annonces[$nb]->setMetaDescription($faker->sentence($nbWords = 4));
            $annonces[$nb]->setDescriptionDuBien($faker->realText(400));
            $annonces[$nb]->setCoupDeCoeur(0);
            $annonces[$nb]->setNombreDePiece($faker->numberBetween(1,7));
            $annonces[$nb]->setLocalisation($villes[$faker->numberBetween(0,10)]);
            $annonces[$nb]->setImageEnAvant('748a5ddfd85adb8e5f03f02fa451a6a3.jpg');
            $images= [];
            for ($j = 0; $j < 2; $j++) {
                $images[$j] = new Photos();
                $images[$j]->setName('748a5ddfd85adb8e5f03f02fa451a6a3.jpg');
                $manager->persist($images[$j]);
                $annonces[$nb]->addImagesDuo($images[$j]);
            }
            $image= [];
            for ($k = 1; $k < 10; $k++) {
                $image[$k] = new Photos();
                $image[$k]->setName('748a5ddfd85adb8e5f03f02fa451a6a3.jpg');
                $manager->persist($image[$k]);
                $annonces[$nb]->addPhotosGalerie($image[$k]);
            }
            $annonces[$nb]->setTypeDeBien($typedebien[$faker->numberBetween(0, 5)]);
            $annonces[$nb]->setSurfaceHabitable($faker->numberBetween(120, 250));
            $annonces[$nb]->setSurfaceDuTerrain($faker->numberBetween(400, 2000));
            $annonces[$nb]->setNombreDeChambre($faker->numberBetween(1, 5));
            $annonces[$nb]->setNombreDeSalleDeBain($faker->numberBetween(1, 3));
            $annonces[$nb]->setNombreEtages($faker->numberBetween(0, 2));
            $annonces[$nb]->setNombreDeToilettes($faker->numberBetween(1, 3));
            $annonces[$nb]->setCheminee($faker->boolean(50));
            $annonces[$nb]->setPiscine($faker->boolean(50));
            $annonces[$nb]->setGarage($faker->boolean(50));
            $annonces[$nb]->setBalcon($faker->boolean(50));
            $annonces[$nb]->setParking($faker->boolean(50));
            $annonces[$nb]->setJardin($faker->boolean(50));
            $annonces[$nb]->setCave($faker->boolean(50));
            $annonces[$nb]->setGardien($faker->boolean(50));
            $annonces[$nb]->setTerrasse($faker->boolean(50));
            $annonces[$nb]->setSystemDeSecurite($faker->text(30));
            $annonces[$nb]->setPrixAvecHonoraires($faker->numberBetween(60000, 2500000));
            $annonces[$nb]->setPrixSansHonoraires($faker->numberBetween(60000, 2500000));

            $manager->persist($annonces[$nb]);


        }
        $manager->flush();
    }
}
