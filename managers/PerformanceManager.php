<?php

class PlayerPerformanceManager extends AbstractManager {

    public function __construct() {
        parent::__construct();
    }

    public function findAllPerformance(): array {
        $query = $this->db->prepare("SELECT * FROM player_performance");
        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $performances = [];

        foreach ($results as $row) {
            $performances[] = new PlayerPerformance(
                $row['id'],
                $row['player'],
                $row['game'],
                $row['points'],
                $row['assists']
            );
        }

        return $performances;
    }

    public function findOnePerformance(int $id): ?PlayerPerformance {
        $query = $this->db->prepare("SELECT * FROM player_performance WHERE id = :id");
        $query->execute([':id' => $id]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new PlayerPerformance(
            $result['id'],
            $result['player'],
            $result['game'],
            $result['points'],
            $result['assists']
        );
    }

    public function createPerformance(PlayerPerformance $performance): void {
        $query = $this->db->prepare("
            INSERT INTO player_performance (player, game, points, assists)
            VALUES (:player, :game, :points, :assists)
        ");

        $query->execute([
            'player' => $performance->getPlayer(),
            'game' => $performance->getGame(),
            'points' => $performance->getPoints(),
            'assists' => $performance->getAssists()
        ]);
    }

    public function updatePerformance(PlayerPerformance $performance): void {
        $query = $this->db->prepare("
            UPDATE player_performance
            SET player = :player, game = :game, points = :points, assists = :assists
            WHERE id = :id
        ");

        $query->execute([
            'player' => $performance->getPlayer(),
            'game' => $performance->getGame(),
            'points' => $performance->getPoints(),
            'assists' => $performance->getAssists(),
            'id' => $performance->getId()
        ]);
}
}