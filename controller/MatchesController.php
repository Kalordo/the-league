<?php

class MatchesController extends AbstractController
{
    private GamesManager $gamesManager;
    
    public function __construct()
    {
        parent::__construct();
        $this->gamesManager = new GamesManager();
    }
    
    public function index(): void
    {
        $games = $this->gamesManager->findAll();
        
        $teamsManager = new TeamsManager();
        $matchesWithDetails = [];
        
        foreach ($games as $game) {
            $team1 = $teamsManager->findOneTeam($game->getTeam_1());
            $logo1 = $mediaManager->findOneMedia($team1->getIdLogo());
            $team2 = $teamsManager->findOneTeam($game->getTeam_2());
            $logo2 = $mediaManager->findOneMedia($team2->getIdLogo());
            
            $matchesWithDetails[] = [
                'game' => $game,
                'team1' => $team1,
                'team2' => $team2,
                'logo1' => $logo1,
                'logo2' => $logo2 
            ];
        }
        
        $this->render('matches/index.html.twig', [
            'matches' => $matchesWithDetails,
            'title' => 'Les Matchs'
        ]);
    }
    
    public function show(int $id): void
    {
        $game = $this->gamesManager->findOne($id);
        
        if (!$game) {
            $this->redirect('matches');
        }
        
        $teamsManager = new TeamsManager();
        
        $team1 = $teamsManager->findOneTeam($game->getTeam_1());
        $logo1 = $mediaManager->findOneMedia($team1->getIdLogo());
        $team2 = $teamsManager->findOneTeam($game->getTeam_2());
        $logo2 = $mediaManager->findOneMedia($team2->getIdLogo());
        
        $performanceManager = new PlayerPerformanceManager();
        $allPerformances = $performanceManager->findAllPerformance();
        
        $gamePerformances = [];
        foreach ($allPerformances as $performance) {
            if ($performance->getGame() == $id) {
                $gamePerformances[] = $performance;
            }
        }
        
        $playersManager = new PlayersManager();
        $performancesWithDetails = [];
        
        foreach ($gamePerformances as $performance) {
            $player = $playersManager->findOne($performance->getPlayer());
            $playerTeam = null;
            
            if ($player) {
                $playerTeamId = (int) $player->getTeam();
                $playerTeam = $teamsManager->findOneTeam($playerTeamId);
            }
            
            $performancesWithDetails[] = [
                'player' => $player,
                'team' => $playerTeam,
                'points' => $performance->getPoints(),
                'assists' => $performance->getAssists()
            ];
        }
        
        $this->render('matches/show.html.twig', [
            'game' => $game,
            'team1' => $team1,
            'team2' => $team2,
            'logo1' => $logo1,
            'logo2' => $logo2,
            'performances' => $performancesWithDetails,
            'title' => $game->getName()
        ]);
    }
}
?>