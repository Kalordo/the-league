<?php

class PlayerPerformance {
    private int $id;
    private int $player;
    private int $game;
    private int $points;
    private int $assists;


        public function __construct(int $id, int $player, int $game, int $points, int $assists) {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->bio = $bio;
        $this->portrait = $portrait;
        $this->team = $team;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getPlayer(): int {
        return $this->player;
    }

    public function setplayer(int $player): void {
        $this->player = $player;
    }

    public function getGame(): int {
        return $this->game;
    }

    public function setgame(int $game): void {
        $this->game = $game;
    }

    public function getPoints(): int {
        return $this->points;
    }

    public function setpoints(int $points): void {
        $this->points = $points;
    }

    public function getAssists(): int {
        return $this->assists;
    }

    public function setassists(int $assists): void {
        $this->assists = $assists;
    }
}