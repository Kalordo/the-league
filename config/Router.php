<?php

class Router
{
 
    private HomeController $hc;
    private TeamsController $tc;
    private PlayersController $pc;
    private MatchesController $mc;
    
    // index() is the default name of the main function to initiate the ROUETR
    
    public function __construct()
    {
        $this->hc = new HomeController();
        $this->tc = new TeamsController();
        $this->pc = new PlayersController();
        $this->mc = new MatchesController();
    }
    
    public function handleRequest(array $get): void
    {
        if (!isset($get['route']))
        {
            $this->hc->index(); //default homepage
        } else if ($get['route'] === 'teams')
        {
            $this->tc->index();
        } else if ($get['route'] === 'team')
        {
            if (isset($get['id']))
            {
                $this->tc->show((int)$get['id']);
            } else
            {
                $this->tc->index();
            }
        } else if ($get['route'] === 'players')
        {
            $this->tc->index();
        } else if ($get['route'] === 'player')
        {
            if (isset($get['id']))
            {
                $this->tc->show((int)$get['id']);
            } else
            {
                $this->tc->index();
            }
        } else if ($get['route'] === 'matches')
        {
            $this->tc->index();
        } else if ($get['route'] === 'match')
        {
            if (isset($get['id']))
            {
                $this->tc->show((int)$get['id']);
            } else
            {
                $this->tc->index();
            }
        }
    }
}

?>