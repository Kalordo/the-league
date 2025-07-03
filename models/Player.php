<?php

class Player {
    private int $id;
    private string $nickname;
    private string $bio;
    private string $portrait;
    private string $team;

    public function __construct(int $id, string $nickname, string $bio, string $portrait, string $team) {
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

    public function getBio(): string {
        return $this->bio;
    }
    public function setBio(string $bio): void {
        $this->bio = $bio;
    }

    public function getNickname(): string {
        return $this->nickname;
    }
    public function setNickname(string $nickname): void {
        $this->nickname = $nickname;
    }

    public function getPortrait(): string {
        return $this->portrait;
    }
    public function setPortrait(string $portrait): void {
        $this->portrait = $portrait;
    }

    public function getTeam(): string {
        return $this->team;
    }
    public function setTeam(string $team): void {
        $this->team = $team;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'bio' => $this->bio,
            'nickname' => $this->nickname,
            'portrait' => $this->portrait,
            'team' -> $this->team
        ];
    }
}