<?php

class GamesManager extends AbstractManager {
    public function __construct() {
        parent::__construct();        
    }

    public function findAll(): array {
        $result = $this->db->query("SELECT * FROM games");
        $gamesResult = $result->fetchAll(PDO::FETCH_ASSOC);

        $games = [];

        foreach ($gamesResult as $gameResult) {
            $games[] = new Games(
                (int) $gameResult['id'],
                $gameResult['name'],
                $gameResult['date'],
                (int) $gameResult['team_1'],
                (int) $gameResult['team_2'],
                (int) $gameResult['winner']
            );
        }

        return $games;
    }

    public function findOne(int $id): ?Games {
        $stmt = $this->db->prepare("SELECT * FROM games WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $gameResult = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($gameResult) {
            return new Games(
                (int) $gameResult['id'],
                $gameResult['name'],
                $gameResult['date'],
                (int) $gameResult['team_1'],
                (int) $gameResult['team_2'],
                (int) $gameResult['winner']
            );
        }
        return null;
    }
}