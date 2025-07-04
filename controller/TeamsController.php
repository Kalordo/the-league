<?php

class TeamsController extends AbstractController
{
    private TeamsManager $teamsManager;
    
    public function __construct()
    {
        parent::__construct();
        $this->teamsManager = new TeamsManager();
    }
    
    public function index(): void
    {
        $teams = $this->teamsManager->findAllTeam();
        $teamsWithLogos = [];
        $mediaManager = new MediaManager();
        
        foreach ($teams as $team) {
            $logo = $mediaManager->findOneMedia($team->getIdLogo());
            $teamsWithLogos[] = [
                'team' => $team,
                'logo' => $logo
            ];
        }
        
        $this->render('teams/index.html.twig', [
            'teams' => $teamsWithLogos,
            'title' => 'Les Teams de la League'
        ]);
    }
    
    public function show(int $id): void
    {
        $team = $this->teamsManager->findOneTeam($id);
        
        if (!$team) {
            $this->redirect('teams');
        }
        
        $playersManager = new PlayersManager();
        $allPlayers = $playersManager->findAll();
        $mediaManager = new MediaManager();
        
        $teamPlayers = [];
        foreach ($allPlayers as $player) {
            $logo = $mediaManager->findOneMedia($player->getPortrait());
            if ($player->getTeam() == $id) {
                $teamPlayers[] = [
                    'player' => $player,
                    'logo' => $logo
                ];
            }
        }
        
        $this->render('teams/show.html.twig', [
            'team' => $team,
            'players' => $teamPlayers,
            'logo' => $logo,
            'title' => $team->getName()
        ]);
    }
}
?>