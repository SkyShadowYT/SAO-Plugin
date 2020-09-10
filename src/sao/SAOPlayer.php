<?php

namespace sao;

use pocketmine\Player;

class SAOPlayer extends Player {

    /** @var int $role */
    private $role = 0;

    /** @var int $xp */
    private $xp = 0;

    /** @var int $level */
    private $levelXP = 0;

    /** @var int $money */
    private $money = 0;

    /** @var string $guild */
    private $guild = "NONE";

    /** @var int $party */
    private $party = 0;

    /** @var array $friends */
    private $friends = [];

    /** @var int ROLE_PLAYER */
    const ROLE_PLAYER = 0;

    /** @var int ROLE_SUPPORT */
    const ROLE_SUPPORT = 1;

    /** @var int ROLE_MODERATOR */
    const ROLE_MODERATOR = 2;

    /**
     * @return int
     */
    public function getRole(): int {
        return $this->role;
    }

    /**
     * @param int $value
     */
    public function setRole(int $value): void {
        $this->role = $value;
    }

    /**
     * @return int
     */
    public function getXp(): int {
        return $this->xp;
    }

    /**
     * @param int $value
     */
    public function setXp(int $value): void {
        $this->xp = $value;
    }

    /**
     * @return int
     */
    public function getLevelXP(): int {
        return $this->levelXP;
    }

    /**
     * @param int $value
     */
    public function setLevelXP(int $value): void {
        $this->levelXP = $value;
    }

    /**
     * @return int
     */
    public function getMoney(): int {
        return $this->money;
    }

    /**
     * @param int $value
     */
    public function addMoney(int $value): void {
        $this->money = $this->money + $value;
    }

    /**
     * @param int $value
     */
    public function subMoney(int $value): void {
        $this->money = $this->money - $value;
    }

    /**
     * @return string
     */
    public function getGuild(): string {
        return $this->guild;
    }

    /**
     * @param string $value
     */
    public function setGuild(string $value): void {
        $this->guild = $value;
    }

    /**
     * @return int
     */
    public function getParty(): int {
        return $this->party;
    }

    /**
     * @param int $value
     */
    public function setParty(int $value): void {
        $this->party = $value;
    }

    /**
     * @return array
     */
    public function getFriends(): array {
        return $this->friends;
    }

    /**
     * @param mixed $value
     */
    public function addFriend(string $value): void {
        $this->friends[] = $value;
    }

    /**
     * @param string $value
     */
    public function delFriend(string $value): void {
        unset($this->friends[$value]);
    }
}