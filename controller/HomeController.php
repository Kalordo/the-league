<?php

class HomeController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
        $this->playersManager = new PlayersManager();
    }

    private PlayersManager $playersManager;
    
    public function index(): void
    {
        $teamsManager = new TeamsManager();
        $teams = $teamsManager->findAllTeam();
        
        $featuredTeam = $teams[0];
        $allPlayers = $this->playersManager->findAll();

        $featuredTeamPlayers = [];
        if ($featuredTeam) {
            foreach ($allPlayers as $player) {
                if ($player->getTeam() == $featuredTeam->getId()) {
                    $featuredTeamPlayers[] = $player;
                }
            }
            $featuredTeamPlayers = array_slice($featuredTeamPlayers, 0, 3);
        }
        
        $featuredPlayers = array_slice($allPlayers, 0, 3);
        
        $playersWithTeams = [];
        foreach ($featuredPlayers as $player) {
            $team = $teamsManager->findOneTeam($player->getTeam());
            $playersWithTeams[] = [
                'player' => $player,
                'team' => $team
            ];
        }
        
        $gamesManager = new GamesManager();
        $games = $gamesManager->findAll();
        $lastMatch = $games[0];
        
        $lastMatchTeams = [];
        if ($lastMatch) {
            $team1 = $teamsManager->findOneTeam($lastMatch->getTeam_1());
            $team2 = $teamsManager->findOneTeam($lastMatch->getTeam_2());
            $lastMatchTeams = ['team1' => $team1, 'team2' => $team2];
        }
        
        $this->render('home/index.html.twig', [
            'featuredTeam' => $featuredTeam,
            'featuredTeamPlayers' => $featuredTeamPlayers,
            'featuredPlayers' => $playersWithTeams,
            'lastMatch' => $lastMatch,
            'lastMatchTeams' => $lastMatchTeams,
        ]);
    }
}
?>
        