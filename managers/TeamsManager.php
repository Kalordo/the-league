<?php

    class TeamsManager extends AbstractManager
    {
        public function __construct(){
            parent::__construct();
        }
        
        public function findAllTeam(): array 
        {
            
            $query = $this->db->prepare('SELECT * FROM teams');
            $query->execute();
            
            $teams = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $teamAll =[];
            foreach($teams as $team){
                $teamObject = new Team();
                $teamObject->setId($team['id']);
                $teamObject->setName($team['name']);
                $teamObject->setDescription($team['description']);
                $teamObject->setIdLogo($team['logo']);
                $teamAll[] = $teamObject;
            }
            
            return $teamAll;
        }
        
        
        public function findOneTeam(int $id){
            $query = $this->db->prepare('SELECT * FROM teams Where id = :id');
            
            $parameters = [
                'id' => $id
            ];
            
            $query->execute($parameters);
            
            if (!$team) {
            return null;
            }
            
            $teamObject = new Team();
            $teamObject->setId($team['id']);
            $teamObject->setName($team['name']);
            $teamObject->setDescription($team['description']);
            $teamObject->setIdLogo($team['logo']);
            
            return $teamObject;
            
        }
    }