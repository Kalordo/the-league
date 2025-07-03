<?php

class TeamManager extends AbstractManager
{
    public function getAllTeams(): array {
        $query = "SELECT t.*, m.url as logo_url, m.alt as logo_alt 
                  FROM teams t 
                  LEFT JOIN media m ON t.logo = m.id 
                  ORDER BY t.name";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $teams = [];
        
        foreach ($results as $row) {
            $teams[] = $this->hydrateTeam($row);
        }
        
        return $teams;
    }

    public function getTeamById(int $id): ?Team {
        $query = "SELECT t.*, m.url as logo_url, m.alt as logo_alt 
                  FROM teams t 
                  LEFT JOIN media m ON t.logo = m.id 
                  WHERE t.id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->hydrateTeam($row) : null;
    }

    public function getTeamPlayers(int $teamId): array {
        $query = "SELECT p.*, m.url as portrait_url, m.alt as portrait_alt 
                  FROM players p 
                  LEFT JOIN media m ON p.portrait = m.id 
                  WHERE p.team = :team_id 
                  ORDER BY p.nickname";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':team_id', $teamId, PDO::PARAM_INT);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $players = [];
        
        foreach ($results as $row) {
            $players[] = $this->hydratePlayer($row);
        }
        
        return $players;
    }

    public function getFeaturedTeam(): ?Team {
        return $this->getTeamById(1);
    }

    private function hydrateTeam(array $data): Team 
    {
        $team = new Team();
        return $team
            ->setId((int) $data['id'])
            ->setName($data['name'])
            ->setDescription($data['description'])
            ->setLogo((int) $data['logo'])
            ->setLogoUrl($data['logo_url'] ?? null)
            ->setLogoAlt($data['logo_alt'] ?? null);
    }

    private function hydratePlayer(array $data): Player 
    {
        $player = new Player();
        return $player
            ->setId((int) $data['id'])
            ->setNickname($data['nickname'])
            ->setBio($data['bio'])
            ->setPortrait((int) $data['portrait'])
            ->setTeam((int) $data['team'])
            ->setPortraitUrl($data['portrait_url'] ?? null)
            ->setPortraitAlt($data['portrait_alt'] ?? null);
    }
}

?>