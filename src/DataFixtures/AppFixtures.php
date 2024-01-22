<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Agent;
use App\Entity\Cible;
use App\Entity\Contact;
use App\Entity\Mission;
use App\Entity\Planque;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {

        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setPassword(password_hash('mdp123', PASSWORD_ARGON2ID));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setNom($this->faker->lastName);
        $admin->setPrenom($this->faker->firstName);



        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');
        $admin->setCreatedAt($createdAt);

        $manager->persist($admin);
        $manager->flush();


        $paysList = [
            'France', 'United States', 'Germany', 'Japan', 'Russia',
            'China', 'United Kingdom', 'Brazil', 'India', 'Italy'
        ];

        $planques = [];
        for ($p = 0; $p < 10; $p++) {
            $planque = new Planque();
            $planque->setCode($this->faker->numberBetween(1000, 9999))
                ->setAdresse($this->faker->address())
                ->setPays($paysList[array_rand($paysList)])
                ->setType($this->faker->randomElement([
                    'Appartement', 'Maison', 'Sous-sol', 'Tunnel souterrain',
                    'Hangar', 'Entrepôt', 'Bunker', 'Château'
                ]));

            $planques[] = $planque;
            $manager->persist($planque);
        }

        $agents = [];
        $currentDate = new \DateTime();
        for ($a = 0; $a < 10; $a++) {
            $minAge = '-50 years';
            $maxAge = '-18 years';
            $birthDate = $this->faker->dateTimeBetween($minAge, $maxAge);

            $agent = new Agent();
            $agent->setNom($this->faker->lastName)
                ->setPrenom($this->faker->firstName)
                ->setNaissance($birthDate)
                ->setCode($this->faker->numberBetween(100, 999))
                ->setPays($paysList[array_rand($paysList)])
                ->setSpecialite($this->faker->randomElement([
                    'Espionnage industriel', 'Cryptographie', 'Infiltration', 'Contre-espionnage', 'Écoute électronique', 'Désinformation', 'Interrogatoire', 'Opérations clandestines', 'Surveillance discrète', 'Analyse comportementale', 'Techniques de camouflage', 'Piratage informatique', 'Contre-terrorisme', 'Extraction d\'informations', 'Gestion des identités fictives'
                ]));

            $agents[] = $agent;
            $manager->persist($agent);
        }

        $cibles = [];
        for ($c = 0; $c < 10; $c++) {
            $minAge = '-50 years';
            $maxAge = '-18 years';
            $birthDate = $this->faker->dateTimeBetween($minAge, $maxAge);

            $cible = new Cible();
            $cible->setNom($this->faker->lastName)
                ->setPrenom($this->faker->firstName)
                ->setNaissance($birthDate)
                ->setCode($this->faker->lexify('??????'))
                ->setPays($paysList[array_rand($paysList)]);


            $cibles[] = $cible;
            $manager->persist($cible);
        }

        $contacts = [];
        for ($ct = 0; $ct < 10; $ct++) {
            $minAge = '-50 years';
            $maxAge = '-18 years';
            $birthDate = $this->faker->dateTimeBetween($minAge, $maxAge);

            $contact = new Contact();
            $contact->setNom($this->faker->lastName)
                ->setPrenom($this->faker->firstName)
                ->setNaissance($birthDate)
                ->setCode($this->faker->lexify('??????'))
                ->setPays($paysList[array_rand($paysList)]);


            $contacts[] = $contact;
            $manager->persist($contact);
        }

        $missions = [];
        for ($m = 0; $m < 30; $m++) {
            $mission = new Mission();
            $mission->setTitre($this->faker->sentence)
                ->setCode($this->faker->lexify('????'))
                ->setDescription($this->faker->paragraph)
                ->setPays($paysList[array_rand($paysList)])
                ->setSpecialiteD($this->faker->randomElement([
                    'Espionnage industriel', 'Cryptographie', 'Infiltration', 'Contre-espionnage', 'Écoute électronique', 'Désinformation', 'Interrogatoire', 'Opérations clandestines', 'Surveillance discrète', 'Analyse comportementale', 'Techniques de camouflage', 'Piratage informatique', 'Contre-terrorisme', 'Extraction d\'informations', 'Gestion des identités fictives'
                ]))
                ->setType($this->faker->randomElement([
                    'Surveillance',
                    'Assassinat',
                    'Infiltration',
                    'Sabotage',
                    'Récupération de renseignements',
                    'Évasion',
                    'Protection',
                    'Enquête',
                    'Recrutement',
                    'Interrogatoire',
                ]))
                ->setStatut($this->faker->randomElement([
                    'En préparation', 'En cours', 'Terminé', 'Échec'
                ]))
                ->setDateDebut($this->faker->dateTimeBetween('-1 month', '+1 month'))
                ->setDateFin($this->faker->dateTimeBetween('+2 months', '+6 months'));

            // Ajoutez des agents, cibles, contacts et planques à chaque mission
            $selectedAgents = $this->faker->randomElements($agents, $this->faker->numberBetween(1, 3));
            foreach ($selectedAgents as $agent) {
                $mission->addAgent($agent);
            }

            $selectedCibles = $this->faker->randomElements($cibles, $this->faker->numberBetween(1, 3));
            foreach ($selectedCibles as $cible) {
                $mission->addCible($cible);
            }

            $selectedContacts = $this->faker->randomElements($contacts, $this->faker->numberBetween(1, 3));
            foreach ($selectedContacts as $contact) {
                $mission->addContact($contact);
            }

            $selectedPlanques = $this->faker->randomElements($planques, 1);
            foreach ($selectedPlanques as $planque) {
                $mission->addPlanque($planque);
            }

            $missions[] = $mission;
            $manager->persist($mission);
        }

        $manager->flush();
    }
}
