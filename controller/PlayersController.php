<?php

class PlayersController extends AbstractController
{
    private PlayersManager $playersManager;
    
    public function __construct()
    {
        parent::__construct();
        $this->playersManager = new PlayersManager();
    }
    
    public function index(): void
    {
        $players = $this->playersManager->findAll();
        
        $teamsManager = new TeamsManager();
        $playersWithTeams = [];
        
        foreach ($players as $player) {
            $teamId = (int) $player->getTeam();
            $team = $teamsManager->findOneTeam($teamId);
            $playersWithTeams[] = [
                'player' => $player,
                'team' => $team
            ];
        }
        
        $this->render('players/index.html.twig', [
            'players' => $playersWithTeams,
            'title' => 'Les Players de la League'
        ]);
    }
    
    public function show(int $id): void
    {
        $player = $this->playersManager->findOne($id);
        
        if (!$player) {
            $this->redirect('players');
        }
        
        $performanceManager = new PlayerPerformanceManager();
        $allPerformances = $performanceManager->findAllPerformance();
        
        $playerPerformances = [];
        foreach ($allPerformances as $performance) {
            if ($performance->getPlayer() == $id) {
                $playerPerformances[] = $performance;
            }
        }
        
        $gamesManager = new GamesManager();
        $teamsManager = new TeamsManager();
        $performancesWithDetails = [];
        
        foreach ($playerPerformances as $performance) {
            $game = $gamesManager->findOne($performance->getGame());
            if ($game) {
                $playerTeamId = (int) $player->getTeam();
                if ($game->getTeam_1() == $playerTeamId) {
                    $adverseTeam = $teamsManager->findOneTeam($game->getTeam_2());
                } else {
                    $adverseTeam = $teamsManager->findOneTeam($game->getTeam_1());
                }
                
                $victory = ($game->getWinner() == $playerTeamId) ? 'Oui' : 'Non';
                
                $performancesWithDetails[] = [
                    'adverseTeam' => $adverseTeam,
                    'points' => $performance->getPoints(),
                    'assists' => $performance->getAssists(),
                    'victory' => $victory
                ];
            }
        }
        
        $allPlayers = $this->playersManager->findAll();
        $teammates = [];
        
        $playerTeamId = (int) $player->getTeam();
        foreach ($allPlayers as $otherPlayer) {
            $otherPlayerTeamId = (int) $otherPlayer->getTeam();
            if ($otherPlayerTeamId == $playerTeamId && $otherPlayer->getId() != $id) {
                $teammates[] = $otherPlayer;
            }
        }
        
        $team = $teamsManager->findOneTeam($playerTeamId);
        $this->render('players/show.html.twig', [
            'player' => $player,
            'team' => $team,
            'performances' => $performancesWithDetails,
            'teammates' => $teammates,
            'title' => $player->getNickname()
        ]);
    }
}
?>