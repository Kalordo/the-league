<?php 

class PlayersManager extends AbstractManager {
    public function __construct() {
        parent::__construct();
    }

    public function findAll(): array {
        $result = $this->db->query("SELECT * FROM players");
        $playersResult = $result->fetchAll(PDO::FETCH_ASSOC);

        $players = [];

        foreach ($playersResult as $playerResult) {
            $players[] = new Player(
                (int) $playerResult['id'],
                $playerResult['nickname'],
                $playerResult['bio'],
                $playerResult['portrait'],
                (int) $playerResult['team']
            );
        }

        return $players;
    }

    public function findOne(int $id): ?Player {
        $stmt = $this->db->prepare("SELECT * FROM players WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $playerResult = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($playerResult) {
            return new Player(
                (int) $playerResult['id'],
                $playerResult['nickname'],
                $playerResult['bio'],
                $playerResult['portrait'],
                (int) $playerResult['team']
            );
        }
        return null;
    }
}