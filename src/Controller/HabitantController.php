<?php

namespace App\Controller;

use App\Entity\Habitant;
use App\Entity\Pays;
use App\Entity\Ville;
use App\Repository\HabitantRepository;
use PhpParser\Node\Stmt\Const_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HabitantController extends AbstractController
{
    public const ESPAGNE = new Pays();
    public const FRANCE = new Pays();
    public const MADRID = new Ville();
    public const PARIS = new Ville();


    private $habitantRepository;

    public function __construct(HabitantRepository $habitantRepository)
    {
        $this->habitantRepository = $habitantRepository;
    }
    /**
     * @Route("/habitant/{id}", name="get_habitant", methods={"GET"})
     */
    public function getHabitant($id): JsonResponse
    {
        $habitant = $this->habitantRepository->findOneBy(['id' => $id]);

    $data = [
        'id' => $habitant->getId(),
        'nom' => $habitant->getNom(),
        'prenom' => $habitant->getPrenom(),
        'age' => $habitant->getCréerLe(),
        'ville' => $habitant->getVille(),
    ];

    return new JsonResponse($data, Response::HTTP_OK);
    }

        /**
     * @Route("/habitant/", name="add_habitant", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $nom = $data['nom'];
        $prenom = $data['prenom '];
        $age = $data['age'];
        $ville = $data['ville'];

        if (empty($nom) || empty($prenom) || empty($age) || empty($ville)) {
            throw new NotFoundHttpException('Les paramètres ne sont pas respectés!');
        }

        $habitant = new Habitant();
        $habitant->setNom($nom);
        $habitant->setPrenom($nom);
        $habitant->setAge($age);
        $habitant->setNom($ville);


        return new JsonResponse(['status' => 'Habitant créer!'], Response::HTTP_CREATED);
    }


}
