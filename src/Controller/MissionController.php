<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/mission')]
class MissionController extends AbstractController
{
    #[Route('/', name: 'app_mission', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator, MissionRepository $missionRepository): Response
    {

        $queryBuilder = $missionRepository->createQueryBuilder('m');


        $query = $queryBuilder->getQuery();
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10 // Nombre d'éléments par page
        );

        return $this->render('mission/index.html.twig', [
            'missions' => $pagination, // Utilise la pagination au lieu de findAll()
            'pagination' => $pagination,
        ]);
    }

    #[Route('/search', name: 'app_mission_search', methods: ['GET'])]
    public function search(Request $request, MissionRepository $missionRepository): Response
    {
        $searchTerm = $request->query->get('term');
    
        $queryBuilder = $missionRepository->createQueryBuilder('m');
    
        if ($searchTerm) {
            $queryBuilder
                ->select('m') // Sélectionne toutes les données de la mission
                ->andWhere('m.titre LIKE :term OR m.description LIKE :term OR m.pays LIKE :term OR m.code LIKE :term OR m.type LIKE :term OR m.statut LIKE :term OR m.id = :id')
                ->setParameter('term', '%' . $searchTerm . '%')
                ->setParameter('id', $searchTerm);
        }
    
        $missions = $queryBuilder->getQuery()->getResult(); // Récupère les résultats sous forme d'entités Mission
    
        // Transforme les résultats en tableau pour la réponse JSON
        $formattedMissions = [];
        foreach ($missions as $mission) {
            $formattedMissions[] = [
                'id' => $mission->getId(),
                'code' => $mission->getCode(),
                'titre' => $mission->getTitre(),
                'description' => $mission->getDescription(),
                'statut' => $mission->getStatut(),
                // Ajoute d'autres champs si nécessaire
            ];
        }
    
        // Retourne la réponse JSON
        return new JsonResponse($formattedMissions);
    }
    
    

    #[Route('/{id}', name: 'app_mission_show', methods: ['GET'])]
    public function show(Mission $mission): Response
    {
        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
        ]);
    }
}
