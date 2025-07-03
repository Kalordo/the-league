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
        
        $teamPlayers = [];
        foreach ($allPlayers as $player) {
            if ($player->getTeam() == $id) {
                $teamPlayers[] = $player;
            }
        }
        
        $mediaManager = new MediaManager();
        $logo = $mediaManager->findOneMedia($team->getIdLogo());
        
        $this->render('teams/show.html.twig', [
            'team' => $team,
            'players' => $teamPlayers,
            'logo' => $logo,
            'title' => $team->getName()
        ]);
    }
}
?>