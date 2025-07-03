<?php

    class MediaManager extends AbstractManager
    {
        public function __construct(){
            parent::__construct();
        }
        
        public function findAllMedia(): array 
        {
            
            $query = $this->db->prepare('SELECT * FROM media ORDER BY id');
            
            $query->execute();
            
            $medias = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $mediaAll =[];
            
            foreach($medias as $mediaObject)
            {
                $mediaObject = new Media($media['url'], $media['alt']);
                $mediaObject->setId($media['id']);
                $mediaAll[] = $mediaObject;
            }
            return $teamAll;
        }
        
        
        public function findOneMedia(int $id): ?Media
        {
            $query = $this->db->prepare('SELECT * FROM media Where id = :id');
            
            $parameters = [
                'id' => $id
            ];
            
            $query->execute($parameters);
            
            $media = $query->fetch(PDO::FETCH_ASSOC);
            
            if (!$media)
            {
                return null;
            }
            
            $mediaObject = new Media($media['url'], $media['alt']);
            $mediaObject->setId($media['id']);
            
            return $mediaObject;
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
        
        
        public function updateMedia(Media $media): void
        {
            $query = $this->db->prepare("
                UPDATE media
                SET url = :url, alt = :alt
                WHERE id = :id
            ");
            $parameters = [
                'url' => $_GET['url'],
                'alt' => $_GET ['alt']
                ];
            $query->execute($parameters);
        }
        
    }
