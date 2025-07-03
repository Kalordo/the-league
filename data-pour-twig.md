home/index.html.twig (index() de HomeController)
    featuredTeam → Équipe à la une
    featuredTeamPlayers → 3 joueurs de cette équipe
    featuredPlayers → 3 joueurs vedettes + leurs équipes
    lastMatch → Dernier match
    lastMatchTeams → Équipes du dernier match
    
teams/index.html.twig  (index() de TeamsController)
    teams → Toutes équipes + logos
    
teams/show.html.twig  (index() de TeamsController)
    team → Équipe spécifique
    players → Joueurs de cette équipe
    logo → Logo de l'équipe
    
players/index.html.twig  (index() de PlayersController)
    players → Tous joueurs + leurs équipes

players/show.html.twig  (index() de PlayersController)
    player → Joueur spécifique
    team → Équipe du joueur
    performances → Stats par match + équipes adverses
    teammates → Coéquipiers

matches/index.html.twig  (index() de MatchesController)
    matches → Tous matchs + équipes + logos

matches/show.html.twig  (index() de MatchesController)
    game → Match spécifique
    team1 + team2 → Les 2 équipes
    logo1 + logo2 → Logos des 2 équipes
    performances → Stats tous joueurs du match
    

ON A OUBLIÉ D'INSTALLER TWIG COMME DES CRÉTINS !!!!!!!!!!!!!!!!!!