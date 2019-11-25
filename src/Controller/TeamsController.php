<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamsController extends AbstractController
{
    /**
     * @Route("/teams", name="teams")
     */
    public function index()
    {
        return $this->render('teams/index.html.twig', [
            'controller_name' => 'TeamsController',
        ]);
    }

    /**
     * @Route(
     *     "/validate/{element}",
     *     name="validatePerson",
     *     methods={"POST"}
     * )
     */
    public function validate(Request $request, string $element)
    {
        try {
            $input = json_decode($request->getContent(), true)['input'];
        } catch (Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        $teams = $this->getTeams();
        switch ($element) {
            case 'team':
                return new JsonResponse(['valid' => in_array(strtolower($input), $teams)]);
        }

        return new JsonResponse(['error' => 'Invalid arguments'], Response::HTTP_BAD_REQUEST);
    }

    private function getStorage()
    {
        return /** @lang json */
            '{
          "team1": {
            "name": "Team1",
            "mentors": [
              "Mantas"
            ],
            "students": [
              "Tadas",
              "Gytis",
              "Ričardas"
            ]
          },
          "baltichalatai": {
            "name": "BaltiChalatai",
            "mentors": [
              "Lukas"
            ],
            "students": [
              "Vytas",
              "Lukas",
              "Diana"
            ]
          },
          "nnizer": {
            "name": "ePacientas",
            "mentors": [
              "Tadas"
            ],
            "students": [
              "Kornelijus",
              "Dominykas",
              "Miglė"
            ]
          },
          "activegen": {
            "name": "ActiveGen",
            "mentors": [
              "Arnoldas"
            ],
            "students": [
              "Andrius",
              "Nojus",
              "Martynas",
              "Edvinas"
            ]
          },
          "mms": {
            "name": "Membership-management-system",
            "mentors": [
              "Mindaugas"
            ],
            "students": [
              "Erika",
              "Rokas",
              "Valentinas",
              "Eligijus"
            ]
          },
          "pamainos": {
            "name": "NFQ pamainu sistema",
            "mentors": [
              "Paulius"
            ],
            "students": [
              "Liudas",
              "Justina",
              "Andrius"
            ]
          },
          "receptai": {
            "name": "Receptai",
            "mentors": [
              "Mantas"
            ],
            "students": [
              "Arnoldas",
              "Arentas",
              "Tautvydas"
            ]
          },
          "pulse": {
            "name": "NFQ pulse",
            "mentors": [
              "Lorenas"
            ],
            "students": [
              "Arvydas",
              "Titas",
              "Kristijonas",
              "Andrius"
            ]
          },
          "lita": {
            "name": "NFQ Petro atrankos problema akademijai",
            "mentors": [
              "Paulius"
            ],
            "students": [
              "Kristina",
              "Indrė",
              "Dmitri"
            ]
          },
          "myfleet": {
            "name": "MyFleet",
            "mentors": [
              "Laurynas"
            ],
            "students": [
              "Artūras",
              "Ignas",
              "Jonas"
            ]
          },
          "career": {
            "name": "NFQ Career Criteria Assessment",
            "mentors": [
              "Erikas"
            ],
            "students": [
              "Matas",
              "Andrius",
              "Ainis"
            ]
          },
          "carparking": {
            "name": "NFQ Car parking",
            "mentors": [
              "Andrejus"
            ],
            "students": [
              "Kęstas",
              "Lukas",
              "Lukas"
            ]
          },
          "podcast": {
            "name": "Krepšinio podcastai",
            "mentors": [
              "Eligijus"
            ],
            "students": [
              "Edvardas",
              "Nerijus",
              "Kazimieras"
            ]
          },
          "Barakas": {
            "name": "barakas",
            "mentors": [
              "Armandas"
            ],
            "students": [
              "Raimondas",
              "Mantas",
              "Tomas"
            ]
          },
          "devcollab": {
            "name": "Education sharing platform",
            "mentors": [
              "Viktoras"
            ],
            "students": [
              "Karolis",
              "Arnas",
              "Evaldas",
              "Algirdas"
            ]
          },
          "hack<b>er</b>\'is po .mySubdomain &project=123": {
            "name": "\' OR 1 -- DROP DATABASE",
            "mentors": [
              "<b>Ponas</b> Programišius"
            ],
            "students": [
              "Aurelijus",
              "<b>Ir</b> jo \"geras\" draug\'as"
            ]
          }
        }';
    }

    private function getTeams(): array
    {
        $teams = [];
        $storage = json_decode($this->getStorage(), true);
        foreach ($storage as $teamName => $projects) {
            $teams[] = strtolower($teamName);
        }
        return $teams;
    }
}
