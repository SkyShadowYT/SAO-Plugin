<?php

namespace sao;

use pocketmine\Player;

class SAOPlayer extends Player {

    /** @var Role $role */
    private $role;

    /** @var int $xp */
    private $xp = 0;

    /** @var int $level */
    private $levelXP = 0;

    /** @var int $money */
    private $money = 0;

    /** @var Guild $guild */
    private $guild = null;

    /** @var Party $party */
    private $party = 0;

    /** @var array $friends */
    private $friends = [];

    /**
     * @return Role
     */
    public function getRole(): Role {
        return $this->role;
    }

    /**
     * @param Role $value
     */
    public function setRole(Role $value): void {
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
     * @return Guild
     */
    public function getGuild(): Guild {
        return $this->guild;
    }

    /**
     * @param Guild $value
     */
    public function setGuild(Guild $value): void {
        $this->guild = $value;
    }

    /**
     * @return Party
     */
    public function getParty(): Party {
        return $this->party;
    }

    /**
     * @param Party $value
     */
    public function setParty(Party $value): void {
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