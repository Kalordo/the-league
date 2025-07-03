<?php

    class MediaManager extends AbstractManager
    {
        public function __construct(){
            parent::__construct();
        }
        
        public function findAllMedia(): array 
        {
            
            $query = $db->prepare('SELECT * FROM media');
            
            $query->execute();
            
            $medias = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $mediaAll =[];
            
            foreach($medias as $mediaObject){
                $mediaAll[]=new Team(
                    
                    $media['name'],
                    $media['description'],
                    $media['logoId']
                    );
            }
            
            return $teamAll;
        }
        
        
        public function findOneTeam(int $id){
            $query = $this->db->prepare('SELECT * FROM teams Where id = :id');
            
            $parameters = [
                'id' => $id
            ];
            
            $query->execute($parameters);
            
            $team = $query->fetch(PDO::FETCH_ASSOC);
            
            $teamOne = new User(
                $team['email'],
                $team['description'],
                $team['logoId']
                );
            $teamOne->id = $team['id'];
            
            return $teamOne;
            
        }
        
        
        public function createTeam(Team $team) : void
        {
            $query = $this->db->prepare("
            INSERT INTO teams (email, description, logoId)
            VALUES (:email, :description, :logoId)");
            $parameters = [
                'email' => $GET['email'],
                'description' => $GET ['description'],
                'logoId' => $GET ['logoId'],
                ];
            $query->execute($parameters);
        }
        
        
        public function updateTeam(Team $team): void
        {
            $query = $this->db->prepare("
                UPDATE teams
                SET email = :email, :description = :description, logoId = :logoId
                WHERE id = :id
            ");
            $parameters = [
                'email' => $GET['email'],
                'description' => $GET ['description'],
                'logoId' => $GET ['logoId'],
                ];
            $query->execute($parameters);
        }
        
    }
