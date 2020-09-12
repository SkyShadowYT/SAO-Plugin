<?php

namespace sao\boss;

use pocketmine\entity\Human;

class Boss extends Human {

    /** @var int $floor */
    private $floor;

    /** @var array $abilities */
    private $abilities = [];

    /**
     * @return int
     */
    public function getFloor(): int {
        return $this->floor;
    }

    /**
     * @param int $value
     */
    public function setFloor(int $value): void {
        $this->floor = $value;
    }

    /**
     * @return array
     */
    public function getAbilities(): array {
        return $this->abilities;
    }

    /**
     * @param int $value
     */
    public function addAbilities(int $value): void {
        $this->abilities[] = $value;
    }
}